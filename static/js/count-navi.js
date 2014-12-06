/**
 * 統計頁面導航
 *
 * Kyle He (admin@hk1229.cn)
 * 2014-12-07 02:50:33;
 */

var selectType = document.querySelector('.select-type');
var selectPage = document.querySelector('.select-page');
function _switch(type, page) {
    location.href = location.href.replace(
        /\d+\/\d+\/?$/,
        type + '/' + page + '/'
    );
}
selectType.addEventListener('change', function() {
    _switch(selectType.value, 1);
});
selectPage.addEventListener('change', function() {
    _switch(selectType.value, selectPage.value);
});
