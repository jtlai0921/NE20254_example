import com.ghostwire.phpobject.*
PHPObject.defaultGatewayKey = "secret";
PHPObject.defaultGatewayUrl = "http://www.example.com/php/flash/Gateway.php";
PHPObject.enableMultiByte = true;

yubin = new PHPObject("ZIPCode");
yubin._visible = false;
// �C�x���g�n���h��
yubin.onInit = function() {
}

yubin.onError = function(i,e) {
  trace(i+"::"+e)
}

yubin.onResult = function(result) {
	trace(result);
	address_txt.text = (result)
}

// �{�^���g���K
submit_btn.onRelease = function() {
	trace(zip_txt.text);
	if (zip_txt.text) {
	  yubin.getInfoByZIP(zip_txt.text);
	}
}
