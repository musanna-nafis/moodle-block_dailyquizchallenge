define(['jquery'], function($) {
    return {
        init: function() {
            $('.dailyquiz-block .dailyquiz-option').on('click', function() {
                const selectedOption = $(this).data('option');
                const correctOption = $(this).closest('.dailyquiz-block').data('correctoption');

                if (selectedOption == correctOption) {
                    alert('✅ Correct Answer. Great job!');
                } else {
                    alert('❌ Wrong Answer. Try again!');
                }
            });
        }
    };
});
