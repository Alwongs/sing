document.addEventListener('DOMContentLoaded', function() {
    const textareaToolbar = document.getElementById('textarea_toolbar');   
    const textareaBlog = document.getElementById('form_textarea_blog');
    const showResultBtn = document.getElementById('show_result_btn');
    const hideResultBtn = document.getElementById('hide_result_window');
    const displayResultWrapper = document.querySelector('.display-result-wrapper');
    const displayResultContent = document.querySelector('.display-result-window__content');

    if (!textareaBlog || !textareaToolbar || !showResultBtn || !displayResultWrapper || !displayResultContent) {
        console.warn('Not all elements found');
        return;
    }

    function appendTemplate(template) {
        textareaBlog.value = textareaBlog.value === '' ? template : textareaBlog.value + '\n' + template;
    } 

    function showResult(content) {
        displayResultWrapper.classList.remove('hidden');
        displayResultContent.innerHTML = content;    // TODO: think about safety adding innerHTML 
    }

    if (hideResultBtn) {
        hideResultBtn.addEventListener('click', function(e) {
            e.preventDefault();
            displayResultWrapper.classList.add('hidden');
        })
    }    

    textareaToolbar.addEventListener('click', function(e) {
        e.preventDefault();
        const button = e.target.closest('button');
        if (!button) return;
        if (button.id === 'show_result_btn') return;
        const key = button.dataset.template;
        const template = window.templates && window.templates[key];
        if (template) appendTemplate(template);
    });
    
    showResultBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showResult(textareaBlog.value);
    });
});
