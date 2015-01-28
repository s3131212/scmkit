#SCMKit 開發版 SCMKit Development Version

此版本為開發版，也就是處於「極度不穩定」、「極度不安全」、「能運作就謝天謝地」的版本，僅供開發者及貢獻者使用，如果您正在尋找 1.0-Alpha 版，我們將於 2015 年初公布。開發版目前只提供繁體中文版，英文版會在近期補上。

This version is the development version, which is "extremely unstable", "extremely unsafe", and you should never use it unless you are developer or contributor. If you are looking for 1.0-Alpha version, we will published in early 2015. Development version is currently available only in Traditional Chinese, the English version will be published soon.

##安裝

1. 下載 development branch
2. 在 /core/database.php 填入 MySQL 連線資訊
3. 把 main.sql 匯入
4. 在 student , teacher , staff 新增帳號，密碼使用 md5
5. 在 index.php/login 登入

##TODO List
1. 功能模組化管理員部分尚未完成，肯請各位協助一起完成
2. XSS 過濾及 CSRF 防護尚未完成
3. 許多功能仍有殘缺和 Bug 和邏輯漏洞，肯請各位協助測試並通報
4. 由於前端工程師表示「拎北不幹了」，UI 改用 Bootstrap
5. 技術文件與註解非常缺乏