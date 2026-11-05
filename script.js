
const emailForm = document.getElementById('emailForm');

emailForm.addEventListener('submit', async function (e) {

    e.preventDefault();

    const sendBtn = document.getElementById('sendBtn');
    const response = document.getElementById('response');

    sendBtn.disabled = true;
    sendBtn.innerHTML = 'Sending...';
    response.innerHTML = '';

    try {

        const formData = new FormData(this);

        const request = await fetch('send.php', {
            method: 'POST',
            body: formData
        });

        const data = await request.json();

        response.innerHTML = `
            <div class="alert ${data.success ? 'alert-success' : 'alert-danger'}">
                ${data.message}
            </div>
        `;


    } catch (error) {

        response.innerHTML = `
            <div class="alert alert-danger">
                Failed to communicate with the server.
            </div>
        `;

        console.error(error);

    } finally {

        sendBtn.disabled = false;
        sendBtn.innerHTML = 'Send Test Email';

    }

});
