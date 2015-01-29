#SCMKit 開發區 SCMKit Development Branch

此處為SCMKit的開發區，所有從這裡下載的東西，都是比開發版更開發版的，也就是處於「極度不穩定」、「極度不安全」、「能運作就謝天謝地」的版本，僅供開發者貢獻使用，如果您正在尋找 1.0-Alpha 版，我們將於 2015 年初公布。

This is the development branch of SCMKit, anything from here is "extremely unstable", "extremely unsafe", and you should never use it unless you are developer who is contributing. If you are looking for 1.0-Alpha version, we will published in early 2015. There's no English support right now.

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
6. 英文支援
