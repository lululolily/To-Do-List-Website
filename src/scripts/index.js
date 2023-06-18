$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

function updateTaskData() {
  $.ajax({
    url: 'php/notification.php',
    method: 'GET',
    success: function(response) {
      $('#taskContainer').html(response);
    }
  });
}

setInterval(updateTaskData, 100); 

function updateTaskCount() {
  $.ajax({
    url: 'php/countnotify.php',
    method: 'GET',
    success: function(response) {
      $('#taskCount').html(response);
    }
  });
}

setInterval(updateTaskCount, 1000); 

var checkboxes = document.querySelectorAll('.form-check-input');
        
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', (event) => {
            var task = checkbox.parentElement.parentElement;
            if (event.currentTarget.checked) {
              task.style.backgroundColor = 'rgba(224, 208, 158, 0.7)';
            } else {
              task.style.backgroundColor = 'rgba(255, 255, 255, 0.8)';
            }});
          });

          function openPopup() {
            document.getElementById('popup').style.display = 'block';
          }
          
          function closePopup() {
            document.getElementById('popup').style.display = 'none';
          }

