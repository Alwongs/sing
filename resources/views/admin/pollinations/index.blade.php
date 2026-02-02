@extends('_layouts.admin')

@section('content')
    <div class="pollinations-container">
        <header class="header">
            <h1 class="header__title">Pollinations chat</h1>
        </header>

        <main class="main">
            <div id="poll-response-notification" class="poll-response-notification">
                <p id="error-notification" class="error-notification"></p>
                <p id="success-notification"  class="success-notification"></p>
            </div>

            <div
                id="pollinations-response"
                class="pollinations-response"
            >
            </div>

            <div class="textarea-block">
                <textarea id="text-input" placeholder="Введите текст..."></textarea>
            </div>

            <div class="poll-submit-section">
                <button id="send-btn" class="poll-submit-btn">Отправить</button>
            </div>
        </main>

        <footer class="footer">
            <p>Footer</p>
        </footer>        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('send-btn').addEventListener('click', async () => {
                const textInput = document.getElementById('text-input').value;

                if (!textInput) {
                    alert('Please fill in the field!');
                    return;
                }

                document.getElementById('pollinations-response').innerHTML += generateUserSection(textInput.trim());   
                document.getElementById('text-input').value = "";
                document.getElementById('pollinations-response').innerHTML += generateThinkingAnimation(); 

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const thinkingVisualization = document.getElementById('ai-thinking-visualization');

                thinkingVisualization.classList.add('hidden');

                setTimeout(() => {
                    thinkingVisualization.classList.remove('hidden');
                }, 10);

                try {
                    const response = await fetch('/ajax/text', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ text: textInput })
                    });
                    const result = await response.json();     
                    
                    thinkingVisualization.classList.add('hidden');        

                    document.getElementById('success-notification').textContent = result.message;                    
                    document.getElementById('pollinations-response').innerHTML += generateAISection(result.ai_message); 
                } catch (error) {
                    document.getElementById('error-notification').textContent = error.message;
                }
            });
        });    
        
        function generateUserSection(content) {
            const result = `
                <div class="poll-user-section">
                    <div class="poll-user-text-block">
                        <h3 class="poll-user-text-block__title">Me :)</h3>
                        <div class="poll-user-text-block__body">${content}</div>
                    </div>
                </div>
            `;
            return result;
        }
        function generateAISection(content) {
            const result = `
                <div class="poll-ai-section">
                    <div class="poll-ai-text-block">
                        <h3 class="poll-ai-text-block__title">'[*!*]'</h3>                        
                        <div class="poll-user-text-block__body">${content}</div>
                    </div>
                </div>
            `;
            return result;
        }        
        function generateThinkingAnimation() {
            const result = `
                <div
                    id="ai-thinking-visualization"
                    class="ai-thinking-visualization hidden"
                >
                    <div class="neuron"></div>
                    <div class="neuron"></div>
                    <div class="neuron"></div>
                    <div class="neuron"></div>
                    <div class="neuron"></div>
                    <div class="pulse-effect"></div>
                </div>              
            `;
            return result;
        }
    </script>
@endsection



