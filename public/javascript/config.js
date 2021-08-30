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

function dateFormat(dateString, time = false, type = "vn") {
    if (dateString == null) {
        return '';
    }
    let date = new Date(dateString);

    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    if (month < 10) {
        month = '0' + month;
    }

    if (day < 10) {
        day = '0' + day;
    }

    if (type === "vn") {
        format = day + "/" + month + "/" + year;
    } else {
        format = year + "-" + month + "-" + day;
    }

    if (time == true) {
        format = date.getHours() + ':' + date.getMinutes() + ', ' + format;
    }

    return format;
}