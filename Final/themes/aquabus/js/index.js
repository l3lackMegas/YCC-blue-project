
function loadComponent(urlPath ,id ,fn){
    return new $.ajax({
      type: "GET",
      url: urlPath,
      data: { },
      success: function(response){
        var elements = $(response);
        var found = $(elements).filter(id);
        console.log('Ref.: "' + id + '", "' + urlPath + '" | Element "#' + $(response).attr('id') + ', .' + $(response).attr('class') + '": ' + found.length);
        if(found.length == 0) {
          $(id).html(elements);
        } else {
          $(id).html(found.html());
        }
        if(fn){fn();
			  //pageHis.push(urlPath);
			  }
      },
      error: function(jqXHR, exception) {
        setTimeout(function() {
          var msg = '';
          if (jqXHR.status === 0) {
              msg = '[' + jqXHR.status +'] คอมพิวเตอร์ของคุณกำลังออฟไลน์อยู่';
          } else if (jqXHR.status == 404) {
              msg = '[' + jqXHR.status +'] ระบบไม่พบที่อยู่ของเซิร์ฟเวอร์ โปรดอัพเดตเวอร์ชั่น 48Gen';
          } else if (jqXHR.status == 500) {
              msg = '[' + jqXHR.status +'] เกิดข้อผิดพลาดภายในเซิร์ฟเวอร์';
          } else if (exception === 'parsererror') {
              msg = '[' + jqXHR.status +'] ร้องขอการวิเคราะห์ล้มเหลว';
          } else if (exception === 'timeout') {
              msg = '[' + jqXHR.status +'] หมดเวลาเชื่อมต่อ';
          } else if (exception === 'abort') {
              msg = '[' + jqXHR.status +'] การเชื่อมต่อถูกยกเลิก';
          } else {
              msg = 'เกิดข้อผิดพลาดที่ไม่คาดคิด.\n' + jqXHR.responseText;
          }
			console.log(msg);
        }, 1500);
      }
    });
}