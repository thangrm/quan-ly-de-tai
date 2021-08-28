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

function getStorageUrl($url) {
    return origin + '/' + folder + '/storage/' + $url;
}