  var slideWidth = 750;
        var sliderTimer;
        $(function () {
            $('.slidewrapper').width($('.slidewrapper').children().size() * slideWidth);
            sliderTimer = setInterval(nextSlide, 4000);
            $('.viewport').hover(function () {
                clearInterval(sliderTimer);
            }, function () {
                sliderTimer = setInterval(nextSlide, 4000);
            });
        });

        function nextSlide() {
            var currentSlide = parseInt($('.slidewrapper').data('current'));
            currentSlide++;
            if (currentSlide >= $('.slidewrapper').children().size()) {
                currentSlide = 0;
            }
            $('.slidewrapper').animate({
                left: -currentSlide * slideWidth
            }, 750).data('current', currentSlide);
        }