<div id="updateSuccessModal" class="success-overlay" style="display: none;">
    <div class="popup-success">
        <div class="popup-box"></div>
        <h2 class="text-4xl font-extrabold my-2">Request Updated!</h2>

        <div class="action-buttons mt-3">
            <button class="btn-ok" onclick="closeSuccessModal()">Confirm</button>
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

    .success-overlay {
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

    .status-actions {
        display: flex;
        justify-content: center;
    }

    .btn-ok {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
    }

    .btn-ok {
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

    .btn-ok:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }
</style>

<script>
    function closeSuccessModal() {
        document.getElementById('updateSuccessModal').style.display = 'none';
    }
</script>
