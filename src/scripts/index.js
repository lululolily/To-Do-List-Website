$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

$(document).ready(function() {
    $('.custom-select').select2({
      minimumResultsForSearch: Infinity,
      templateResult: function(data) {
        var $icon = $(data.element).data('icon');
        var $text = $(data.element).text();
        if (!$icon) {
          return $text;
        } else {
          return $('<span><i class="' + $icon + '"></i> ' + $text + '</span>');
        }
      },
      templateSelection: function(data) {
        var $icon = $(data.element).data('icon');
        var $text = $(data.element).text();
        if (!$icon) {
          return $text;
        } else {
          return $('<span><i class="' + $icon + '"></i> ' + $text + '</span>');
        }
      }
    });
  });

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
          
          function saveReminder(event) {
            event.preventDefault();
            let form = document.getElementById("form");
            let name = form.elements["task-name"].value;
            let date = form.elements["date-time"].value;
            let category = form.elements["category"].value;
            let status = form.elements["status"].value;
            let output = document.getElementById("output");

            let categoryClass, statusClass;
  
            if (status === "To-Do") {
              statusClass = "badge bg-info";
            } else if (status === "In Progress") {
              statusClass = "badge bg-secondary";
            } else if (status === "Completed") {
              statusClass = "badge bg-success";
            } 

            if (category === "Priority") {
              categoryClass = "badge bg-danger";
            } else if (category === "Deadline") {
              categoryClass = "badge bg-warning";
            }

            output.innerHTML += `
            <button type="button" class="task d-flex flex-column">
              <div class="d-flex align-items-center">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">` + name + `</label>
              </div>
              <div>
                <p class="` + categoryClass + `">` + category + `</p>
                <p class="` + statusClass + `">` + status + `</p>
              </div>
            </button>`;

            console.log(output.innerHTML);
            /*
            const taskName = document.getElementById('task-name').value;
            const dueDate = document.getElementById('date-time').value;
            const category = document.getElementById('category').value;
            const status = document.getElementById('status').value;
          
            console.log('Task Name: ${taskName}, Due Date: ${dueDate}, Category: ${category}, Status: ${status}');
            // Do something with the form values (e.g. save to database)
            closePopup();
            */
           form.reset();
           closePopup();
          }