$(document).ready(function() {

    
    $(".choose").change(function () {
        $("select option").prop("disabled", false);
        $(".choose").not($(this)).find("option[value='" + $(this).val() + "']").prop("disabled", true);
        $("#f").hide();
        $("#rbook").hide();
        $("#button4").show();
        $("#book").hide();
        $('#b').hide();
        $("#book1").hide();
    });


    $("#cabtype").change(function(){
      $("#rbook").hide();
      $("#button4").show();
        $("#book").hide();
        $("#f").hide();
        $('#b').hide();
        $("#book1").hide();
    })

    $("#lugg").keyup(function(){
      $("#rbook").hide();
      $("#button4").show();
      $("#book").hide();
      $("#f").hide();
      $('#b').hide();
      $("#book1").hide();
    })

    $("#pickup").keyup(function(){
        $("#rbook").hide();
        $("#button4").show();
        $("#book").hide();
        $("#f").hide();
        $('#b').hide();
        $("#book1").hide();
      })

      $("#drop").keyup(function(){
        $("#rbook").hide();
        $("#f").hide();
        $("#button4").show();
        $("#book").hide();
        $('#b').hide();
        $("#book1").hide();
      })

    $("#lugg").bind("keypress", function (e) {
      
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 48 && keyCode <= 57)) {
          return false;
        }
    });
    

    $("#mobile").bind("keypress", function (e) {
      var keyCode = e.which ? e.which : e.keyCode
      if (!(keyCode >= 48 && keyCode <= 57)) {
        return false;
      }
  });

    $('#err').hide();
     $cabtyp = $('#cabtype'), $lug = $('#lugg');
        $cabtyp.change(function () {
            if ($cabtyp.val() == 'CedMicro') {
                $lug.attr('disabled', 'disabled').val('');
                $('#err').show();
            } else {
                $lug.removeAttr('disabled');
                $('#err').hide();
            }
        }).trigger('change');
        
        $('#nu').hide();
        $('#ep').hide();
        $('#ed').hide();
        $('#ec').hide();
        $('#b').hide();
        $("#f").hide();
        $('#book').hide();
        $('#book1').hide();
        $('#rbook').hide();

   $("#button4").click(function(e){
        e.preventDefault();
        $pickup=$("#pickup").val();
        $drop=$("#drop").val();
        $cabtype=$("#cabtype").val();
        $lugg=$("#lugg").val();
        $f = $("#f").val();
        if(isNaN($lugg)){
            $('#fare').show();
            $('#book').hide();
            $("#f").hide();
            $('#b').hide();
            $('#book1').hide();
            return $('#nu').show();
        }
        else{ 

            $('#nu').hide();
        }
        if($pickup==null)
        {
            $('#book').hide();
            $("#f").hide();
            $('#b').hide();
            $('#book1').hide();
            return $('#ep').show();
        }
        else{
            $('#ep').hide();
        }
        console.log($drop);
        if($drop=="")
        {
            $('#book').hide();
            $("#f").hide();
            $('#b').hide();
            $('#book1').hide();
            return $('#ed').show();
        }
        else{
            $('#ed').hide();
        }
        console.log($cabtype);
        if($cabtype=="")
        {
            $('#book').hide();
            $("#f").hide();
            $('#b').hide();
            $('#ed').hide();
            $('#book1').hide();
            return $('#ec').show();
            
        }
        else{
            $('#ec').hide();
        }
        if($pickup=="")
        {
            $('#book').hide();
            $("#f").hide();
            $('#b').hide();
            $('#book1').hide();
            return $('#ep').show();
        }
        else{
            $('#ep').hide();
        }
        if($drop==null)
        {
            $('#book').hide();
            $("#f").hide();
            $('#b').hide();
            $('#book1').hide();
            return $('#ed').show();
        }
        else{
            $('#ed').hide();
        }
        $.ajax({
            url: 'process.php',
            type: 'post',
            data:{
                pickup : $pickup,
                drop : $drop,
                cabtype : $cabtype,
                lugg : $lugg,
                f : $f  
            },
             dataType : "json",
            success: function (result) {
                $('#dist').val(result['dist']);
                $('#nu').hide();
                $('#ep').hide();
                $('#ed').hide();
                $('#ec').hide();
                $('#fare').hide();
                $('#button4').hide();
                $('#book').show();
                $("#f").show();
                $('#b').show();
                $('#book1').show();
                $('#far').val(result['fare']);
            }, 
            error: function () {
                alert(error);
            }
        });
    });
});


$("#book").click(function(e){
    e.preventDefault();
        $pickup=$("#pickup").val();
        $drop=$("#drop").val();
        $cabtype=$("#cabtype").val();
        $lugg=$("#lugg").val();
        $far=$("#far").val();
        $f = $("#f").val();
    $.ajax({
        url: 'book.php',
        type: 'post',
        data:{
            pickup : $pickup,
            drop : $drop,
            cabtype : $cabtype,
            lugg : $lugg,
            far : $far,
            f : $f
        },
        success: function (result) {
            $('#rbook').show();
            $('#book').hide();
            $("#f").show();
            $('#b').hide();
            $('#button4').hide();
        },
        error: function () {
            $('#book').show();
            $('#b').show();
            $('#rbook').hide();
            $('#button4').show();
            alert(error);
        }
    });
    
});

 $('#allr').show();
 $('#ernr').hide();
$('#srt').show();
$("#allrid").click(function(){
    $('#allr').show();
    $('#ernr').hide();
    $('#cstats').show();
    $('#srt').show();
    $('#drp').show();
});

$("#ernrid").click(function(){
    $('#ernr').show();
    $('#allr').hide();
    $('#srt').hide();
    $('#drp').hide();
});


 $('#allru').show();
  $('#ernru').hide();
  $('#drp').show();
  $("#allridu").click(function(){
    $('#allru').show();
    $('#ernru').hide();
    $('#srt').show();
    $('#cstats').show();
    $('#drp').show();
});

$("#ernridu").click(function(){
    $('#ernru').show();
    $('#allru').hide();
    $('#drp').hide();
});
$('#edi').show();
$('#cpaa').hide();
$('#edipr').click(function(){
    $('#edi').show();
    $('#cpaa').hide();
});
$('#chpa').click(function(){
    $('#cpaa').show();
    $('#edi').hide();
});

    $("#cfil").change(function() {
        var value = $(this).val().toLowerCase();
        $("#tblc tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $("#tbl1c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          $("#tbl2c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          $("#tbl3c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          $("#tbl4c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
      });

      $("#cstat").change(function() {
        var value = $(this).val().toLowerCase();
        $("#tblc tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $("#tbl1c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          $("#tbl2c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          $("#tbl3c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          $("#tbl4c tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
      });

    
    $('#penrd').click(function(){
      $('#allr').hide();
      $('#penr').show();
      window.location.href="allrides.php";
    })

