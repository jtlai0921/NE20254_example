import com.ghostwire.phpobject.*;
PHPObject.defaultGatewayKey = "secret";
PHPObject.defaultGatewayUrl = "http://php/part2/chap2/Gateway.php";
PHPObject.enableMultiByte = true;

yubin = new PHPObject("ZIPCode");
yubin._visible = false;

yubin.onInit = function() {
}

yubin.onError = function(i,e) {
  trace(i+"::"+e)
}

yubin.onResult = function(result) {
	trace(result);
	address_txt.text = (result)
}

// 按鈕觸發
submit_btn.onRelease = function() {
	trace(zip_txt.text);
	if (zip_txt.text) {
	  yubin.getInfoByZIP(zip_txt.text);
	}
}

