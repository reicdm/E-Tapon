<div id="updSchModal" class="confirm-overlay" style="display: none;">
    <div class="popup-confirm">
        <div class="circle-pop"></div>
        <h2 class="my-2">Are you sure you want to update the status?</h2>

        <div class="action-buttons mt-4">
            <button class="btn-confirm" onclick="confirmPopSchRequest()">Confirm</button>
            <button class="btn-cancel" onclick="closeConfirmSchModal()">Cancel</button>
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

    .circle-pop {
        flex-shrink: 0;
        border-radius: 50%;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* TOP ICON CONTAINER */
    .circle-pop {
        width: 80px;
        height: 80px;
        background-color: var(--color-orange);
    }

    .status-actions {
        display: flex;
        justify-content: center;
    }

    .btn-confirm {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
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
    function confirmPopSchRequest() {
        const modal = document.getElementById('updSchModal');

        // Get stored data from modal
        const type = modal.dataset.type;
        const status = modal.dataset.status;
        const schedId = modal.dataset.schedId;
        const brgyId = modal.dataset.brgyId;
        const requestId = modal.dataset.requestId;

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("collector.schedule.update") }}';

        // CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Type
        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'type';
        typeInput.value = type;
        form.appendChild(typeInput);

        // Status
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        form.appendChild(statusInput);

        // Conditional inputs
        if (type === 'scheduled') {
            const schedIdInput = document.createElement('input');
            schedIdInput.type = 'hidden';
            schedIdInput.name = 'sched_id';
            schedIdInput.value = schedId;
            form.appendChild(schedIdInput);

            const brgyIdInput = document.createElement('input');
            brgyIdInput.type = 'hidden';
            brgyIdInput.name = 'brgy_id';
            brgyIdInput.value = brgyId;
            form.appendChild(brgyIdInput);
        } else {
            const requestIdInput = document.createElement('input');
            requestIdInput.type = 'hidden';
            requestIdInput.name = 'request_id';
            requestIdInput.value = requestId;
            form.appendChild(requestIdInput);
        }

        document.body.appendChild(form);
        form.submit();
    }

    function closeConfirmSchModal() {
        document.querySelectorAll('[class*="clicked-status-"]').forEach(content => {
            content.style.maxHeight = null;
            content.classList.remove('clicked-status-open');
        });

        document.querySelectorAll('.collapsible.active').forEach(btn => {
            btn.classList.remove('active');
        });

        document.getElementById('updSchModal').style.display = 'none';
    }
</script>