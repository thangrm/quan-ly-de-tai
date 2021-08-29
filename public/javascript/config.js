let origin = window.location.origin;
let folder = 'QuanLyDeTai'

function getBaseUrl($url) {
    return origin + '/' + folder + '/' + $url;
}

function getAPIUrl($url) {
    return origin + '/' + folder + '/api/' + $url;
}

function getRole($url) {
    if (isset($_SESSION['login']['role'])) {
        return $_SESSION['login']['role'];
    } else {
        return -1;
    }
}

function getImgUrl(nameFile) {
    return origin + '/' + folder + '/public/images/' + nameFile;
}

function getStorageUrl($url) {
    return origin + '/' + folder + '/storage/' + $url;
}

function dateFormat(dateString, time = false) {
    if (dateString == null) {
        return '';
    }
    let date = new Date(dateString);
    let month = date.getMonth() + 1;
    if (date.getMonth() < 10) {
        month = '0' + month;
    }

    format = date.getDate() + "/" + month + "/" + date.getFullYear();
    if (time == true) {
        format = date.getHours() + ':' + date.getMinutes() + ', ' + format;
    }

    return format;
}