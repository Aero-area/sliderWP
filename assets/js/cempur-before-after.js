(function () {
    'use strict';

    function clamp(value, min, max) {
        return Math.min(max, Math.max(min, value));
    }

    function getPointPosition(event, slider, orientation) {
        var rect = slider.getBoundingClientRect();
        var pointX = event.clientX;
        var pointY = event.clientY;

        if (orientation === 'vertical') {
            return clamp((pointY - rect.top) / rect.height, 0, 1);
        }

        return clamp((pointX - rect.left) / rect.width, 0, 1);
    }

    function applyPosition(slider, beforeLayer, handle, orientation, position) {
        var clipValue = (1 - position) * 100;

        if (orientation === 'vertical') {
            beforeLayer.style.clipPath = 'inset(0 0 ' + clipValue + '% 0)';
            handle.style.left = '50%';
            handle.style.top = position * 100 + '%';
        } else {
            beforeLayer.style.clipPath = 'inset(0 ' + clipValue + '% 0 0)';
            handle.style.left = position * 100 + '%';
            handle.style.top = '50%';
        }

        slider.style.setProperty('--cempur-position', String(position));
        slider.setAttribute('data-position', String(position));
        slider.dispatchEvent(new CustomEvent('cempur:position-change', {
            detail: {
                position: position
            }
        }));
    }

    function syncImageRatio(slider) {
        var beforeImage = slider.querySelector('.cempur-ba-image-before img');
        var afterImage = slider.querySelector('.cempur-ba-image-after img');

        function setRatioFromImage(image) {
            if (!image || !image.naturalWidth || !image.naturalHeight) {
                return false;
            }

            slider.style.setProperty('--cempur-image-ratio', image.naturalWidth + ' / ' + image.naturalHeight);
            return true;
        }

        if (setRatioFromImage(beforeImage) || setRatioFromImage(afterImage)) {
            slider.classList.add('is-ready');
        }

        [beforeImage, afterImage].forEach(function (image) {
            if (!image) {
                return;
            }

            if (image.complete) {
                setRatioFromImage(image);
                return;
            }

            image.addEventListener('load', function () {
                if (setRatioFromImage(image)) {
                    slider.classList.add('is-ready');
                }
            }, { once: true });
        });
    }

    function isInteractiveTarget(target) {
        if (!target || !target.closest) {
            return false;
        }

        return !!target.closest('.cempur-ba-cta, .cempur-ba-fullscreen');
    }

    function syncFullscreenState(slider) {
        slider.classList.toggle('is-fullscreen', document.fullscreenElement === slider);
    }

    function toggleFullscreen(slider) {
        if (!document.fullscreenEnabled) {
            return;
        }

        if (document.fullscreenElement === slider) {
            document.exitFullscreen();
            return;
        }

        slider.requestFullscreen();
    }

    function setupFullscreen(slider) {
        var fullscreenToggle = slider.querySelector('.cempur-ba-fullscreen');

        if (!fullscreenToggle) {
            return;
        }

        if (!document.fullscreenEnabled || !slider.requestFullscreen) {
            fullscreenToggle.style.display = 'none';
            return;
        }

        fullscreenToggle.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            toggleFullscreen(slider);
        });

        document.addEventListener('fullscreenchange', function () {
            syncFullscreenState(slider);
        });
    }

    function setupSlider(slider) {
        if (!slider || slider.dataset.cempurInitialized === '1') {
            return;
        }

        var beforeLayer = slider.querySelector('.cempur-ba-image-before');
        var handle = slider.querySelector('.cempur-ba-handle');

        if (!beforeLayer || !handle) {
            return;
        }

        var orientation = slider.getAttribute('data-orientation') === 'vertical' ? 'vertical' : 'horizontal';
        var initialPosition = parseFloat(slider.getAttribute('data-position') || '0.5');
        var position = clamp(isNaN(initialPosition) ? 0.5 : initialPosition, 0, 1);
        var pointerId = null;

        function updateFromEvent(event) {
            position = getPointPosition(event, slider, orientation);
            applyPosition(slider, beforeLayer, handle, orientation, position);
        }

        function onPointerDown(event) {
            if (isInteractiveTarget(event.target)) {
                return;
            }

            pointerId = event.pointerId;
            slider.setPointerCapture(pointerId);
            updateFromEvent(event);
        }

        function onPointerMove(event) {
            if (pointerId === null || event.pointerId !== pointerId) {
                return;
            }
            updateFromEvent(event);
        }

        function onPointerUp(event) {
            if (pointerId === null || event.pointerId !== pointerId) {
                return;
            }

            slider.releasePointerCapture(pointerId);
            pointerId = null;
        }

        function onClick(event) {
            if (event.target === handle || isInteractiveTarget(event.target)) {
                return;
            }
            updateFromEvent(event);
        }

        slider.addEventListener('pointerdown', onPointerDown);
        slider.addEventListener('pointermove', onPointerMove);
        slider.addEventListener('pointerup', onPointerUp);
        slider.addEventListener('pointercancel', onPointerUp);
        slider.addEventListener('click', onClick);

        applyPosition(slider, beforeLayer, handle, orientation, position);
        setupFullscreen(slider);

        syncImageRatio(slider);

        slider.dataset.cempurInitialized = '1';
    }

    function initAllSliders(context) {
        var scope = context || document;
        var sliders = scope.querySelectorAll('.cempur-ba-slider');

        sliders.forEach(function (slider) {
            slider.dataset.cempurInitialized = '';
            setupSlider(slider);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initAllSliders(document);
        });
    } else {
        initAllSliders(document);
    }

    if (window.elementorFrontend && window.elementorFrontend.hooks) {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/cempur_before_after.default', function ($scope) {
            initAllSliders($scope[0]);
        });
    }

    window.CempurBeforeAfter = window.CempurBeforeAfter || {};
    window.CempurBeforeAfter.initAllSliders = initAllSliders;
})();
