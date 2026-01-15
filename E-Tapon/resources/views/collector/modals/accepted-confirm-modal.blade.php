<div id="updateModal" class="confirm-overlay" style="display: none;">
    <div class="popup-confirm">
        <div class="align-center">
            <img src="{{ asset('icons/schedule.png') }}" class="schedule-img">
        </div>
        <h2 class="my-2">Are you sure you want to update the status?</h2>

        <div class="action-buttons mt-4">
            <button class="btn-confirm" onclick="confirmUpdateRequest()">Confirm</button>
            <button class="btn-cancel" onclick="closeUpdateConfirmModal()">Cancel</button>
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

    .schedule-img {
        width: 80px;
        height: 80px;
        padding: 0.25rem;
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
    function confirmRequest() {
        document.getElementById('updateModal').style.display = 'none';
        document.getElementById('updateSuccessModal').style.display = 'flex';
    }

    function closeConfirmModal() {
        document.getElementById('updateModal').style.display = 'none';
        document.getElementById('acceptedModal').style.display = 'flex';
    }
</script>