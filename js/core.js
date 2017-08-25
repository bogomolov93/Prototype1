var my_errors = {fio: false, login: false, pass: false};
$(document).ready(function () {

    $('body').on('click', '#check_profile', function (event) {
        var first_name = this.getElementsByTagName("td")[0].innerHTML;
        var last_name = this.getElementsByTagName("td")[1].innerHTML;
        var middle_name = this.getElementsByTagName("td")[2].innerHTML;
        var cons = this.getElementsByTagName("td")[4].innerHTML;
        var age = this.getElementsByTagName("td")[5].innerHTML;
        var status = this.getElementsByTagName("td")[6].innerHTML;
        var visits = this.getElementsByTagName("td")[7].innerHTML;
        var lose = this.getElementsByTagName("td")[8].innerHTML;
        var no_visit = this.getElementsByTagName("td")[9].innerHTML;
        var tel = this.getElementsByTagName("td")[11].innerHTML;
        var purchase = this.getElementsByTagName("td")[12].innerHTML;
		var id_client = this.getElementsByTagName("td")[13].innerHTML;
		

        $("#checklist").modal();
        $('#fio').text(first_name + ' ' + ' ' + last_name + ' ' + middle_name);
        $('#age').text('Возраст - ' + age);
        $('#visits').text(visits);
        $('#lose').text(lose);
        $('#no_visit').text(no_visit);
        $('#tel').text('Телефон - ' + tel);
        $('#consultant').text('Консультант - ' + cons);
        $('#purchase').text('Покупки - ' + purchase);
		
		
    	$('body').on('click', 'button#open_profile', function (event) {
        	location.href = "client_profile.php?id="+id_client;
		});
    });


    $('body').on('click', 'button#add_client', function (event) {
        event.preventDefault();

        var name_client = document.getElementById('client_name').value;
        var last_name_client = document.getElementById('client_last_name').value;
        var middle_name_client = document.getElementById('client_middle_name').value;
        var birthday_client = document.getElementById('client_birthday').value;
        var tel_client = document.getElementById('client_tel').value;
        var email_client = document.getElementById('client_email').value;
        var skype_client = document.getElementById('client_skype').value;
        var area_client = document.getElementById('client_region').value;
        var adr_client = document.getElementById('client_adr').value;
        var learned_client = document.getElementById('client_learned').value;
        var cons_client = document.getElementById('client_cons').value;
        var event_client = document.getElementById('client_event').value;
        var client_status = document.getElementById('client_status').value;

        if (name_client != "" && last_name_client != "" && middle_name_client != "" && birthday_client != "" && client_status != "") {
            $.ajax({
                type: "POST",
                url: "actions.php",
                data: "mode=add_new_client" +
                "&name_client=" + name_client +
                "&last_name_client=" + last_name_client +
                "&middle_name_client=" + middle_name_client +
                "&birthday_client=" + birthday_client +
                "&tel_client=" + tel_client +
                "&email_client=" + email_client +
                "&skype_client=" + skype_client +
                "&area_client=" + area_client +
                "&adr_client=" + adr_client +
                "&learned_client=" + learned_client +
                "&cons_client=" + cons_client +
                "&event_client=" + event_client +
                "&client_status=" + client_status,
                success: function (data) {
                }
            });
        } else {
            alert("Заполните обязательные поля");
        }
    });

	$('body').on('click', 'button#add_history', function (event) {
		$("#modal_add_history").modal();
		var text_history = document.getElementById('text_history');
		var id_client = document.getElementById('id_client').value;			
			$('body').on('click', 'button#modal_add_history', function (event) {	//text_history.value
				if(id_client != null && text_history != ""){
					$.ajax({
						 type: "POST",
               			 url: "actions.php",
						 data: "mode=add_new_history" +
						 "&id_client=" + id_client + 
						 "&history=" + text_history.value,
						 success: function (data) {
						 alert("Запись добавлена");
						 location.href = "client_profile.php?id="+id_client;
                 		}
           		 	});

				}
			});
	});
	
	$('body').on('click', 'button#add_photo', function (event) {
		$("#modal_add_photo").modal();
	});

});