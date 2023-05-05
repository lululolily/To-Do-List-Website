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

          function saveTask(event) {
            event.preventDefault();
            let form = document.getElementById("task");
            let name = form.elements["task-name"].value;
            let dateInput = form.elements["date-time"];
            let date = new Date(dateInput.value);
            let category = form.elements["category"].value;
            let status = form.elements["status"].value;
            let deadline = document.getElementById("deadline");
            let priority = document.getElementById("priority");

            const options = {
              weekday: 'short',
              month: 'short',
              day: 'numeric',
              hour: 'numeric',
              minute: 'numeric',
              hour12: true
            };
            
            const dateObj = new Date();
            const dateStr = dateObj.toLocaleDateString('en-MY', options);

            let categoryClass, statusClass;
  
            if (status === "To-Do") {
              statusClass = "badge bg-dark";
            } else if (status === "In Progress") {
              statusClass = "badge bg-secondary";
            } else if (status === "Completed") {
              statusClass = "badge bg-success";
            } 

            if (category === "Priority 1") {
              categoryClass = "badge bg-danger";
            } else if (category === "Priority 2") {
              categoryClass = "badge bg-info";
            } else if (category === "Priority 3") {
              categoryClass = "badge bg-light";
            } else if (category === "Deadline") {
              categoryClass = "badge bg-warning";
            }
            
              if (category === "Priority 1"){
                priority.innerHTML += `
                <button type="button" class="weeklist">
                  <h5>` + name + `</h5>
                  <h6 class="prioritydate" style="display: inline-block;">` + dateStr + `</h6>
                  <div class="badges">
                    <p class="` + categoryClass + `">` + category + `</p>
                    <p class="` + statusClass + `">` + status + `</p>
                  </div>
                </button>`;
                console.log(priority.innerHTML);
              } else if (category === "Priority 2") {
                priority.innerHTML += `
                <button type="button" class="weeklist">
                  <h5>` + name + `</h5>
                  <h6 class="prioritydate" style="display: inline-block;">` + dateStr + `</h6>
                  <div class="badges">
                    <p class="` + categoryClass + `">` + category + `</p>
                    <p class="` + statusClass + `">` + status + `</p>
                  </div>
                </button>`;
                console.log(priority.innerHTML);
              } else if (category === "Priority 3") {
                priority.innerHTML += `
                <button type="button" class="weeklist">
                  <h5>` + name + `</h5>
                  <h6 class="prioritydate" style="display: inline-block;">` + dateStr + `</h6>
                  <div class="badges">
                    <p class="` + categoryClass + `">` + category + `</p>
                    <p class="` + statusClass + `">` + status + `</p>
                  </div>
                </button>`;
                console.log(priority.innerHTML);
              }
                else if (category === "Deadline") {
                deadline.innerHTML += `
                <button type="button" class="weeklist">
                  <h5>` + name + `</h5>
                  <h6 class="deadlinedate" style="display: inline-block;">` + dateStr + `</h6>
                  <div class="badges">
                    <p class="` + categoryClass + `">` + category + `</p>
                    <p class="` + statusClass + `">` + status + `</p>
                  </div>
                </button>`;
                console.log(deadline.innerHTML);
              }

            form.reset();
            closePopup();
          }