$(window).load(function(){

    $("select#countries-searchcountries").change(function(){
       var $val = $(this).children(":selected").attr('value');
       document.location.href="/tours?ToursSearch[country_to_id]="+$val;
//     $("select#countries-searchcountries option[value="+$val+"]").attr("selected", "selected");
    });

})

function parseResponse(response)
{
    if(response.errorVotes){
    swal({
      type: 'warning',
      title: 'Вы голосовали!',
    })
    }

	if (response.error) {
		showError(response.error);
	}
    if (response.success) {
        showSuccess(response.success);
    }
    if (response.closeModal) {
        ModalClose(response.closeModal);
    }
    if (response.openm) {
            modalOpen(response.openm);
        }
	if (response.refresh) {
		window.location.reload(true);
	}
	if (response.redirect) {
		window.location.href = response.redirect;
	}
	if(response.replaces instanceof Array)
	{
		for(var i = 0, ilen = response.replaces.length; i < ilen; i++)
		{
			$(response.replaces[i].what).replaceWith(response.replaces[i].data);
		}
	}
	if(response.append instanceof Array)
	{
		for(i = 0, ilen = response.append.length; i < ilen; i++)
		{
			$(response.append[i].what).append(response.append[i].data);
		}
	}
	if(response.js)
	{
		$("body").append(response.js);
	}
	jsFunctionsAssign();
}
function jsFunctionsAssign()
{

}
function showSuccess(success)
{
    swal("Успешно",success,"success");
}
function modalOpen(openModal)
{
     $(openModal).easyModal({
                top: 100,
                autoOpen: true,
                overlayOpacity: 0.3,
                overlayColor: "#333",
                overlayClose: true,
                closeOnEscape: true
            });
}
function ModalClose(closeModal)
{
    $(closeModal).trigger('closeModal');
}
function showError(error)
{
	swal("Ошибка",error,"error");
}
// yii submit form
function submitForm (element, url, params) {
	var f = $(element).parents('form')[0];
	if (!f) {
		f = document.createElement('form');
		f.style.display = 'none';
		element.parentNode.appendChild(f);
		f.method = 'POST';
	}
	if (typeof url == 'string' && url != '') {
		f.action = url;
	}
	if (element.target != null) {
		f.target = element.target;
	}

	var inputs = [];
	$.each(params, function(name, value) {
		var input = document.createElement("input");
		input.setAttribute("type", "hidden");
		input.setAttribute("name", name);
		input.setAttribute("value", value);
		f.appendChild(input);
		inputs.push(input);
	});

	// remember who triggers the form submission
	// this is used by jquery.yiiactiveform.js
	$(f).data('submitObject', $(element));

	$(f).trigger('submit');

	$.each(inputs, function() {
		f.removeChild(this);
	});
}



$(function(){
	$(document).on('submit', 'form.ajax-form', function (event) {
		event.preventDefault();
		var that = this;
		jQuery.ajax({'cache': false, 'type': 'POST', 'dataType': 'json', 'data':$(that).serialize(), 'success': function (response) {
			parseResponse(response);
		}, 'error': function (response) {
			alert(response.responseText);
		}, 'beforeSend': function() {

		}, 'complete': function() {

		}, 'url': this.action});
		return false;
	});
	$(document).on('click', 'a.submit-form-link', function (event) {
		var that = this;
		if(!$(that).data('confirm') || confirm($(that).data('confirm'))) {
			submitForm(
				that,
				that.href,
				$(that).data('params')
			);
			return false;
		} else {
			return false;
		}
	});
	$(document).on('click', 'a.ajax-link', function (event) {
		event.preventDefault();
		var that = this;
		if($(that).data('confirm') && !confirm($(that).data('confirm'))) {
			return false;
		}
		jQuery.ajax({'cache': false, 'type': 'POST', 'dataType': 'json', 'data':$(that).data('params'), 'success': function (response) {
			parseResponse(response);
		}, 'error': function (response) {
			alert(response.responseText);
		}, 'beforeSend': function() {

		}, 'complete': function() {

		}, 'url': that.href});
		return false;
	});

    $("select#send_mark").change(function(){
        var $val = $(this).children(":selected").attr('value');
        $.ajax({
            url: 'http://api.auto.ria.com/categories/1/marks/'+$val+'/models/_group',
            type: 'get',
            dataType: 'json',
            success: function(data){

                $.each(data, function(key,value) {
                    console.log(key,value);
                    $('#get_models')
                        .append($("<option></option>")
                            .attr("value",value.value)
                            .text(value.name));
                });
            }
        });
    });

        $("select#fuels").change(function(){
            var $val = $(this).children(":selected").attr('fuel-type');
            var $val2 = $(this).children(":selected").attr('car-id');
            $.ajax({
                url: '/updategear/'+$val2,
                type: 'get',
                dataType: 'json',
                data:{fueltype:$val},
                beforeSend:function(){
                    $('#gear').children().remove().end()
                },
                success: function(data){
                    $.each(data, function(key,value) {
                        $.each(value, function(k,v) {
                            console.log(k),
                            console.log(v),
                            $('#gear')
                                .append($("<option></option>")
                                    .attr("value",k)
                                    .text(v));
                        });
                    });
                }
            });
        });

    $(document).on('click', '#getPrice', function (event) {
        $.ajax({
            url: 'http://api.auto.ria.com/average?',
            type: 'get',
            dataType: 'json',
            success: function(data){
                $.each(data, function(key,value) {
                    $('#region')
                        .append($("<option></option>")
                            .attr("value",value.value)
                            .text(value.name));
                });
            }
        });
    });



});

$(document).ready(function(){
    //Datepicker Init

    $("#dateP").datepicker({
        dateFormat:'dd.mm.yy',
        minDate:0
    });
//Datepicker RU
    /* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
    /* Written by Andrew Stromnov (stromnov@gmail.com). */
    (function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define([ "../datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }(function( datepicker ) {

        datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3C;Пред',
            nextText: 'След&#x3E;',
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                'Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            weekHeader: 'Нед',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
        datepicker.setDefaults(datepicker.regional['ru']);

        return datepicker.regional['ru'];

    }));

    var $nYears = '';
    var $nMark = '';
    var $nModel = '';
    var $nSeries = '';
    var $nMod = '';
    var $nRace = '';
    var $nCanCome = '';
    var $nEmail = '';
    //Serie Image
    $(document).on('#series','click',function(){
        var $serie = $(this).attr('data-serie');
        $.ajax({
            url: '/getimage/'+$serie,
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if(data.source != 'false'){
                    $('#image').attr('src',data.source);
                }
            }
        });

    });
//Master Animation
//Step 1 to 2
    $('.goStepTwo').click(function (e) {
        e.preventDefault();
        var $mark = $("#mark option:selected").val();
        var $model = $("#model option:selected").val();
        var $year = $("#year option:selected").val();
        var $checkModel = $('#model option').size();

        $nMark = $mark;
        $nModel = $model;
        $nYears= $year;
        if($nMark == ''){
            swal("Ошибка", "Не торопитесь, пожалуйста укажите марку авто", "error");
        }else if($nModel == ''){
            swal("Ошибка", "Не торопитесь, пожалуйста укажите модель", "error");
        }else if($nYears == '') {
            swal("Ошибка", "Не торопитесь, пожалуйста укажите год", "error");
        }else if($nMark != '' && $nModel != '' && $nYears != '' && $checkModel >= 1){
            $.ajax({
                url: '/checkri/',
                type: 'POST',
                dataType: 'json',
                data: {email:$nEmail,race:$nRace,year:$nYears},
                success: function(data){
                    if(data.true == 'true'){
                        AnimateTransition({
                            container: '.master',
                            blockIn: '.stepTwo',
                            blockOut: '.stepOne',
                            animation: 'slide-in',
                            onTransitionStart: function (blockIn, blockOut, container, event) {
                                $('html').addClass('overflow');
                                $('.stepOne').hide();
                                $('.faq').hide();
                                $('footer').hide();
                            },
                            onTransitionEnd: function (blockIn, blockOut, container, event) {
                                $('.stepTwo').show().addClass('animated slideInRight');
                                $('.faq').show(2000);
                                $('footer').show(2000);
                            }
                        });
                    }else if(data.false == 'false'){

                        AnimateTransition({
                            container: '.master',
                            blockIn: '.stepThree',
                            blockOut: '.stepOne',
                            animation: 'slide-in',
                            onTransitionStart: function (blockIn, blockOut, container, event) {
                                $('html').addClass('overflow');
                                $('.faq').hide();
                                $('footer').hide();
                            },
                            onTransitionEnd: function (blockIn, blockOut, container, event) {
                                $('.stepThree').show().addClass('animated slideInRight');
                                $('.faq').show(2000);
                                $('footer').show(2000);
                            }
                        });


                    }
                }
            });


        }

    });
    //Step 2 to 3
    $('.goStepThree').click(function (e) {
        e.preventDefault();
        var $series = $("#series option:selected").val();
        var $mod = $("#mod option:selected").val();
        $nSeries = $series;
        $nMod = $mod;
        console.log($nMark,$nMod,$nSeries,$nModel);
        if($('#series :selected').val() == ''){
            swal("Ошибка", "Не торопитесь, укажите серию авто", "error");
        }else if($('#mod :selected').val() == '') {
            swal("Ошибка", "Не торопитесь, укажите модификацию авто", "error");
        }else if($('#series :selected').val() != '' && $('#mod :selected').val() != ''){
            AnimateTransition({
                container: '.master',
                blockIn: '.stepThree',
                blockOut: '.stepTwo',
                animation: 'slide-in',
                onTransitionStart: function (blockIn, blockOut, container, event) {
                    $('html').addClass('overflow');
                    $('.faq').hide();
                    $('footer').hide();
                },
                onTransitionEnd: function (blockIn, blockOut, container, event) {
                    $('.stepThree').show().addClass('animated slideInRight');
                    $('.faq').show(2000);
                    $('footer').show(2000);
                }
            });
        }

    });
    //Final 3-4
    $('.goStepFour').click(function (e) {
        e.preventDefault();
        $nRace = $("#racei").val();
        $nCanCome = $('input[name="willYouCome"]:checked').val();
        $nEmail = $("#email").val();
        console.log($nRace,$nCanCome,$nEmail);
        if($nRace == ''){
            swal("Ошибка", "Пожалуйста укажите пробег", "error");
        }else if(!$nCanCome){
            swal("Ошибка", "Пожалуйта укажите возможность приехать к нам в наш местный филиал", "error");
        }else if($nEmail == '') {
            swal("Ошибка", "Пожалуйста укажите Ваш email", "error");
        } else if($nRace != '' && $nCanCome && $nEmail != ''){
            if($nSeries.length === 0){
                var $flase = false;
                $.ajax({
                    url: '/cr/'+$nMark+'/'+$nModel+'/'+$flase+'/'+$nCanCome,
                    type: 'POST',
                    dataType: 'json',
                    data: {email:$nEmail,race:$nRace,year:$nYears},
                    success: function(data){
                        if(data.success == 'true'){
                            $('#price_to').text(data.price_to);
                            $('#model_name').text(data.model_name);
                            $('#fuel_name').text(data.fuel_name);
                            $('#gear_name').text(data.gear_name);
                            $('#year_from').text(data.year_from);
                            $('#year_to').text(data.year_to);
                            $('#request_id').text(data.request_id);
                            $('#engine_volume').text(data.engine_volume);
                            $('#race').text(data.race);
                        }else if(data.success == 'lockdown'){
                            $('.cap').hide();
                            $('.SR').hide();
                            $('.WR').hide();
                            $('.result-success').hide();
                            $('.result-caution').hide();
                            $('.result-negative').show();
                        }
                    }
                });
            }else{
                var $statRace = 100000;
                $.ajax({
                    url: '/cr/'+$nMark+'/'+$nModel+'/'+$nMod+'/'+$nCanCome,
                    type: 'POST',
                    dataType: 'json',
                    data: {email:$nEmail,race:$nRace,year:$nYears},
                    success: function(data){
                        if(data.success == 'true'){
                            $('#price_to').text(data.price_to);
                            $('#model_name').text(data.model_name);
                            $('#fuel_name').text(data.fuel_name);
                            $('#gear_name').text(data.gear_name);
                            $('#year_from').text(data.year_from);
                            $('#year_to').text(data.year_to);
                            $('#request_id').text(data.request_id);
                            $('#engine_volume').text(data.engine_volume);
                            $('#race').text(data.race);
                        }else if(data.success == 'lockdown'){
                            $('.cap').hide();
                            $('.SR').hide();
                            $('.WR').hide();
                            $('.price').hide();
                            $('#sorry').show();
                        }
                    }
                });
            }

            AnimateTransition({
                container: '.master',
                blockIn: '.stepFour',
                blockOut: '.stepThree',
                animation: 'slide-in',
                onTransitionStart: function (blockIn, blockOut, container, event) {
                    $('html').addClass('overflow');
                    $('.faq').hide();
                    $('footer').hide();
                },
                onTransitionEnd: function (blockIn, blockOut, container, event) {
                    $('.stepFour').show().addClass('animated slideInRight');
                    $('.faq').show(2000);
                    $('footer').show(2000);
                }
            });
        }

    });
    $(function(){
     $('#accordion').accordion({
      collapsible: true,
      animated: 'slide',
      autoHeight: false,
      navigation: true
     });
     var hash = window.location.hash;
     var thash = hash.substring(hash.lastIndexOf('#'), hash.length);
     $('#accordion').find('a[href*='+ thash + ']').parent('h3').trigger('click');
     if (hash === '#howitwork') {
        $( "#accordion" ).accordion( "option", "active", 0 );
     }
    })
    $(window).on('hashchange',function(){
         var hash = window.location.hash;
         var thash = hash.substring(hash.lastIndexOf('#'), hash.length);
         $('#accordion').find('a[href*='+ thash + ']').parent('h3').trigger('click');
    });
    $('.see').click(function(e){
        e.preventDefault();
        var $request_id = $('#request_id').text();
        var $otdelenie = $(this).attr('data-otdelenie');
        var $time = $(this).attr('data-time');
        console.log($request_id,$otdelenie,$time);
        $.ajax({
            url: '/addsee/',
            type: 'POST',
            dataType: 'json',
            data:{request_id:$request_id,otdelenie:$otdelenie,time:$time},
            success: function(data){
                if(data.success == 'true'){
                    swal("Успешно", "Вы успешно записались на показ", "success");
                }else{
                    swal("ОШибка", "Что-то пошло не так", "warning");
                }
            }
        });
    });



    $('#series').change(function(e){
        var $mod = $('select#series option:selected').val()
        $.ajax({
            url: '/carimage/'+$mod,
            type: 'get',

            dataType: 'json',
            success: function(data)
            {
                $('#carImageStep2 img:last-child').remove();
                $('#carImageStep3 img:last-child').remove();
                $('#carImageStep4 img:last-child').remove();

                $('#carImageStep2').append('<img src="'+data.source+'">');
                $('#carImageStep3').append('<img src="'+data.source+'">');
                $('#carImageStep4').append('<img src="'+data.source+'">');
            }
        });
    });
    $('#sendZayavka').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '/addZayavka',
            type: 'POST',
            dataType: 'json',
            success: function(data)
            {

            }
        });
    });
    $('.showTable').click(function(e){
        e.preventDefault();
        console.log('click');
        $('#NewModal').easyModal({
            top: 100,
            autoOpen: true,
            overlayOpacity: 0.3,
            overlayColor: "#333",
            overlayClose: true,
            closeOnEscape: true
        });
    });

    /*$(document).on('click','#car_detail',function(e){
        e.preventDefault();
        $('#car').easyModal({
            top: 100,
            autoOpen: true,
            overlayOpacity: 0.3,
            overlayColor: "#333",
            overlayClose: true,
            closeOnEscape: true
        });
        //Или
        $("#car").trigger('openModal');
    });*/


    $('#car_detail').click(function(e){
        e.preventDefault();
        console.log('click');
        $('#car').easyModal({
            top: 100,
            autoOpen: true,
            overlayOpacity: 0.3,
            overlayColor: "#333",
            overlayClose: true,
            closeOnEscape: true
        });
    });

    $('#car_change').click(function(e){
        e.preventDefault();
        console.log('click');
        $('#car_change_form').easyModal({
            top: 100,
            autoOpen: true,
            overlayOpacity: 0.3,
            overlayColor: "#333",
            overlayClose: true,
            closeOnEscape: true
        });
		$(document).ready(function () {
			$(".car_change_scroll_cont").customScrollbar();

			//resize static scrollbar when new photos added
			var target = document.querySelector('.add-foto-w .add-foto-w');

			var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

			var observer = new MutationObserver(function(mutations) {
    			mutations.forEach(function(mutation) {
					setTimeout('$(".car_change_scroll_cont").customScrollbar("resize")', 300);
    			});
			});

			var config = {
				childList: true,
				subtree: true,
			}

			observer.observe(target, config);
		});
    });




});
