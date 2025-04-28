define(['jquery'], function($) {
    return {
        init: function() {
            $('.dailyquiz-block .dailyquiz-option').on('click', function() {
                const selectedOption = $(this).data('option');
                const correctOption = $(this).closest('.dailyquiz-block').data('correctoption');
                const messageDiv = $(this).closest('.dailyquiz-block').find('.dailyquiz-message');

                if (selectedOption == correctOption) {
                    messageDiv
                        .html('<span class="correct">✅ Correct Answer. Great job!</span>')
                        .removeClass('wrong')
                        .addClass('correct');
                } else {
                    messageDiv
                        .html('<span class="wrong">❌ Wrong Answer. Try again!</span>')
                        .removeClass('correct')
                        .addClass('wrong');
                }
            });
        }
    };
});
