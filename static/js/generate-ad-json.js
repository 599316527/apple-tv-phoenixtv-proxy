var adMeta = {
    dataList: [],
    curPage: 1,
    _write_time: 0
};
var adVideo = {
    videoid: null,
    ratio: '16:9',
    videoplayurl: null,
    categoryId: null,
    columnName: null,
    _write_time: 0
};

function getNowTimeStamp() {
    return (new Date).getTime();
}

function $(selector) {
    return document.querySelector(selector);
}
function $$(selector) {
    return document.querySelectorAll(selector);
}

function getFormData() {
    var data = {};
    var ctrls = $$('.form input, .form select');
    for (var i = ctrls.length - 1; i >= 0; i--) {
        data[ctrls[i].id] = ctrls[i].value;
    }
    var selectCtrl = $('#column');
    data['columnTitle'] = selectCtrl.selectedOptions[0].innerText;
    return data;
}

$('#generate-button').addEventListener('click', function () {
    var data = getFormData();
    if (parseInt(data['column'], 10) < 0 || !data['guid']) return ;
    var time = getNowTimeStamp();
    data['wordText'] = data['fullTitle'] = data['imageText'] + data['title'];
    data['_write_time'] = time;
    adMeta['dataList'][0] = data;
    adVideo['videoid'] = data['guid'];
    adVideo['videoplayurl'] = data['videourl'];
    adVideo['categoryId'] = data['column'];
    adVideo['columnName'] = data['columnTitle'];
    adVideo['_write_time'] = time;
    $('#ad-meta-path').innerText = 'caceh/ad/' + data['column'];
    $('#ad-meta-value').value = JSON.stringify(adMeta);
    $('#ad-video-path').innerText = 'caceh/video/' + data['guid'];
    $('#ad-video-value').value = JSON.stringify(adVideo);
});
















