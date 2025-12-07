<div id="appModal">
  <div id="modalContainer">
    <h1 id="modalTitle">title</h1>
    <p id="modalMessage">message</p>
  </div>
  <script>
    function showModal(title, message = '', error = false) {
      appModal.style.display = 'block';
      modalTitle.innerText = title;
      modalMessage.innerText = message;
    }

    function hideModal() {
      appModal.style.display = 'none';
    }
  </script>
</div>
