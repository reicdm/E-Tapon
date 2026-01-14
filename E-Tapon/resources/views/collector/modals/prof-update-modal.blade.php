<div id="saveModal" class="confirm-overlay" style="display: none;">
    <div class="popup-confirm">
        <div class="align-center">
            <img src="{{ asset('icons/profile.png') }}" class="profile-img">
        </div>
        <h2 class="my-2">Are you sure about your changes?</h2>

        <div class="action-buttons mt-4">
            <button class="btn-confirm" onclick="confirmSaveProfile()">Confirm</button>
            <button class="btn-cancel" onclick="closeSaveModal()">Cancel</button>
        </div>
    </div>
</div>

<style>
    :root {
        --color-dark-green: #1f4b2c;
        --color-mid-green: #4d7111;
        --color-orange: #ff9100;
        --color-light-olive: #d5ed9f;
        --color-cream: #fffbe6;
    }

    body {
        font-family: "Roboto", sans-serif;
    }

    .confirm-overlay {
        position: fixed;
        inset: 0;
        background: rgb(0, 0, 0, 0.50);
        backdrop-filter: blur(10px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup-confirm,
    .popup-success {
        background: var(--color-cream);
        color: var(--color-dark-green);
        width: 340px;
        height: 240px;
        padding: 20px;
        border-radius: 30px;
        text-align: center;

        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    }

    .popup-confirm h2 {
        font-size: 20px;
        font-weight: bold;
    }

    .popup-box {
        width: 160px;
        height: 100px;
        background: var(--color-orange);
        border-radius: 30px;
    }

    .profile-img {
        width: 80px;
        height: 80px;
        padding: 0.25rem;
    }

    /* TOP ICON CONTAINER */
    .circle-pop {
        width: 80px;
        height: 80px;
        background-color: var(--color-orange);
    }

    .status-actions,
    .action-buttons {
        display: flex;
        justify-content: center;
    }

    .btn-confirm {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
        border: none;
    }

    .btn-cancel {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid;
        border-color: var(--color-orange);
        margin-left: 12px;
    }

    .btn-confirm,
    .btn-cancel {
        width: 110px;
        padding: 5px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;

        position: relative;
        top: 0;
        display: inline-block;

        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        transition: all 0.2s ease;
    }

    .btn-confirm:active,
    .btn-cancel:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }
</style>

<script>
    function closeSaveModal() {
        document.getElementById('saveModal').style.display = 'none';
    }

    function confirmSaveProfile() {
        // Get form data
        const contactNumber = document.getElementById('contact_number').value;
        const email = document.getElementById('email').value;

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("collector.profile.update") }}';

        // CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Contact Number
        const contactInput = document.createElement('input');
        contactInput.type = 'hidden';
        contactInput.name = 'contact_number';
        contactInput.value = contactNumber;
        form.appendChild(contactInput);

        // Email
        const emailInput = document.createElement('input');
        emailInput.type = 'hidden';
        emailInput.name = 'email';
        emailInput.value = email;
        form.appendChild(emailInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>