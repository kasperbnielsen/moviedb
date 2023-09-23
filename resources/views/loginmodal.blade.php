<div id="myModal" class="modal">

    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Some text in the Modal..</p>
    </div>

</div>
<script>
    document.querySelector('.close').addEventListener('click', (event) => {
        document.querySelector('.modal').style.visibility = "hidden";
    })
</script>
<style>
    .modal {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        position: fixed;
        left: 0;
        bottom: 0;
        top: 0;
        right: 0;
        background-color: #fefefe;
        margin: 5rem 15rem 5rem 15rem;
        width: auto;
        height: auto;
        padding: 20px;
        border: 1px solid #888;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>