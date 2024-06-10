<style>
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .loading-overlay .spinner-border {
        width: 3rem;
        height: 3rem;
    }
</style>

<div id="loading-overlay" class="loading-overlay">
    <div class="spinner-border text-dark" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
