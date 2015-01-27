
function getNowTimeStamp() {
    return Math.round((new Date).getTime() / 1000);
}

function $(selector) {
    return document.querySelector(selector);
}
function $$(selector) {
    return document.querySelectorAll(selector);
}

function format(source, var_args) {
    source = String(source);

    var data = Array.prototype.slice.call(arguments, 1);
    var len = data.length;
    return source.replace(/\{(\d+)\}/g, function(match, index) {
        index = parseInt(index, 10);
        return (index >= len ? match : data[index]);
    });

    return source;
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

$('#generate-button').addEventListener('click', function () {
    var data = getFormData();
    if (parseInt(data['column'], 10) < 0 || !data['guid']) return ;
    var time = getNowTimeStamp();
    data['wordText'] = data['fullTitle'] = data['imageText'] + ' ' + data['title'];
    adMeta['dataList'][0] = data;
    adMeta['_write_time'] = time;
    adVideo['videoid'] = data['guid'];
    adVideo['videoplayurl'] = data['videourl'];
    adVideo['categoryId'] = data['column'];
    adVideo['columnName'] = data['columnTitle'];
    adVideo['_write_time'] = time;
    var metaPath = 'cache/ad/' + data['column'];
    var metaValue = JSON.stringify(adMeta);
    $('#ad-meta-path').innerText = metaPath;
    $('#ad-meta-value').value = metaValue;
    var videoPath = 'cache/video/' + data['guid'];
    var videoValue = JSON.stringify(adVideo);
    $('#ad-video-path').innerText = videoPath;
    $('#ad-video-value').value = videoValue;
    $('#ad-shell-value').value = format(
        'echo "{0}" > "{1}"\necho "{2}" > "{3}"\n',
        metaValue.replace(/"/g, '\\"'), metaPath,
        videoValue.replace(/"/g, '\\"'), videoPath
    );
});





