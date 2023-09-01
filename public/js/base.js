function js_validate_amt_dec(e){
  if( e.which!=8 && e.which!=0 && e.which!=46 && (e.which<48 || e.which>57))
    return false;
  
  setTimeout(function() {
      js_delay_validate_amt_dec($(e.target),e.keyCode,e.which);
  }, 100)
  if(e.which==46)
    return false;
}
function js_delay_validate_amt_dec(nam,keycode,keywhich,dec_point) {
  dec_point=(dec_point==undefined)?2:dec_point;
  var ss = $(nam).val().split(".");
  if( (keycode=="46" || keycode=="8" || keycode=="0") && $(nam).val()=="" ) {
    $(nam).val("0.00");
    ss = $(nam).val().split(".");
  }
  if(ss[1]==undefined || ss[1].length<dec_point){
    $(nam).val((isNaN(parseFloat($(nam).val()).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat($(nam).val()).toFixed(dec_point));
    $(nam).selectRange(ss[0].length); 
  } else if(ss[1].length>=dec_point) {
    if( ($(nam)[0].selectionStart>ss[0].length && keycode!="37") || ($(nam)[0].selectionStart-1)>ss[0].length){
      if(keycode=="37") {
        $(nam).selectRange( ($(nam)[0].selectionStart-1), ($(nam)[0].selectionStart) );
      }else if(keycode=="110" || keycode=="190"){

      } else {
        if(ss[1].length>=dec_point) {
          var ssdd = $(nam).val().split(".");
          if(dec_point=="1") {
            $(nam).val( (isNaN(parseFloat(Math.floor($(nam).val()*100)/100).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat((Math.floor($(nam).val())+String(ssdd[1])+"0")/100).toFixed(dec_point) );
          } else {
            $(nam).val( (isNaN(parseFloat(Math.floor($(nam).val()*100)/100).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat(Math.floor($(nam).val())+String(ssdd[1])/100).toFixed(dec_point) );
          }
          $(nam).selectRange(($(nam).val().length-1),$(nam).val().length); 
        } else {
          $(nam).selectRange($(nam)[0].selectionStart, ($(nam)[0].selectionStart+1) );
        }
      }
    } else if(keycode=="37" && $(nam)[0].selectionStart>ss[0].length) {
      $(nam).selectRange(ss[0].length); 
    } else if(ss[1].length>dec_point) {
      $(nam).val( (isNaN(parseFloat(Math.floor($(nam).val()*100)/100).toFixed(dec_point)))?parseFloat("0").toFixed(dec_point):parseFloat(Math.floor($(nam).val()*100)/100).toFixed(dec_point) );
      $(nam).selectRange($(nam).val().length); 
    }
  }
  if(keywhich=="46"){
    $(nam).selectRange(ss[0].length+1, (ss[0].length+2) );
  }
}
$.fn.selectRange = function(start, end) {
    if(!end) end = start; 
    return this.each(function() {
        if (this.setSelectionRange) {
            this.focus();
            this.setSelectionRange(start, end);
        } else if (this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};