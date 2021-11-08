//Кол-во дней хранения cookie
var days_to_store = 90;
//Параметр для определения источника трафика в момент совершения целевого действия
var deduplication_cookie_value = 'admitad';

//Параметры создания cookie с последним источником трафика
var deduplication_cookie_name = 'deduplication_cookie';
var deduplication_channel_name = 'utm_source';

//Параметры создания cookie с UID admitad
var uid_cookie_name = 'tagtag_aid';
var uid_channel_name = 'tagtag_uid';

function getParamFromUriAdmitad (get_param_name) {
	var pattern = get_param_name + '=([^&]+)';
	var re = new RegExp(pattern);
	return (re.exec(document.location.search) || [])[1] || '';
};

// функция для записи источника в cookie с именем cookie_name
function setAdmitadCookie (param_name, cookie_name) {
	var param = getParamFromUriAdmitad(param_name);
	if (!param) { return; }
	var period = days_to_store * 60 * 60 * 24 * 1000;	// в секундах
	var expiresDate = new Date((period) + +new Date);
	var cookieString = cookie_name + '=' + param + '; path=/; expires=' + expiresDate.toGMTString();
	document.cookie = cookieString;
	document.cookie = cookieString + '; domain=.' + 'samsung.com';
};

// запись куки
setAdmitadCookie(uid_channel_name, uid_cookie_name);
setAdmitadCookie(deduplication_channel_name, deduplication_cookie_name);
