apple-tv-phoenixtv-proxy
========================

用於享看TV個人服务器的凤凰卫视节目獲取代理

## 用法

把這個加到「個人服務器」里就能看了
```
鳳凰衛視   http://hk1229.cn/demo/phoenixtv/
```
如果要看更多的往期視頻，請在網址最後加上 `?more=yes`

## 實現

通過分析 ifeng.com 視頻播放頁面得到 API 如下：

功能 | 地址
---------|-----
節目列表 | `http://v.ifeng.com/docvlist/${CPID}/${column_id}-${page}.js?callback=jsonp6`
視頻信息 | `http://dyn.v.ifeng.com/cmpp/video_msg_ipad.js?msg=${guid}&param=playermsg&callback=jsonp3`

由於 Apple TV 平台的限制，需要使用 rewrite 來構造出**目錄**和**視頻**地址。

