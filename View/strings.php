<?php
function getPageTitle($pageUrl = 1){
    echo "کوتاه کننده لینک جی وان";
}

function getPageMetaDescription($pageDesc = 1){
    echo "به اسانی لینک های خود را کوتاه کنید و کسب درامد کنید";
}

function getKeyWords($pageKeyWord = 1){
    echo "link,short";
}
//end global functions


//article functions
function getCollapsibleMenuTitle($numberItem){ //this show main collapsible manu TITLE in home page
    switch ($numberItem){
        case 1:
            echo "فواید لینک کوتاه";
            break;
        case 2:
            echo "چرا جی وان؟";
            break;
        case 3:
            echo "کسب درآمد";
            break;
        case 4:
            echo "تبلیغات";
            break;
    }
}
function getCollapsibleMenuText($numberItem){ //this show main collapsible manu DESCRIPTION in home page
    switch ($numberItem){
        case 1:
            echo '
            <p>لینک کوتاه به طور مستقیم باعث افزایش کاربران ورودی می شود.</p>
            <p>یک بک لینک خوب برای سایت یا وبلاگ شما بوده که باعث افزایش رنک وب سایت شما می شود.</p>
            <p>امکان مخفی کردن لینک مقصد را در شبکه های اجتماعی فراهم می آورد.</p>
            ';
            break;
        case 2:
            echo '
                <p>امکان استفاده از لینک دلخواه را فراهم می آورد</p>
                <p>با انتقال صفحه با ریدایرکت ۳۰۱ باعث می شود رنک وبسایت شما حفظ شود</p>
            ';
            break;
        case 3:
            echo '
            <p>در صورت تمایل میتوانید از هر بازدید کسب درآمد کنید</p>
            <p>برای اینکار باید در سایت ثبت نام کنید و در تنظیمات کسب درآمد را تیک بزنید</p>
            <p>به ازای هر بازدید ۱۰۰ ریال به حساب شما اضافه میشود</p>
            ';
            break;
        case 4:
            echo '
            <p>محصول خود را به سادگی برای هزاران کاربر به نمایش بگذارید</p>
            <p>تبلیغات با بهره وری بالا</p>
            ';
            break;
    }
}

//panel functions
function getUserNameInPanel(){
    return "لورم ایپسوم";
}

//end article functions

function getFooterDiv(){
    echo '
    <div class="container">
        <div class="row">
            <div class="col l3 xl3 m3 hide-on-small-only">
                <ul>
                    <h5 class="white-text bold">حامیان ما</h5>
                    <li><a class="grey-text text-lighten-3" href="#!">فروشگاه اینترنتی دونامال</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">شرکت تک دیتا</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">کامروسافت</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">لینکست</a></li>
                </ul>
            </div>
            <div class="col l9 xl9 m9 s12">
                <h5 class="white-text center-align bold">درباره جی وان</h5>
                <h6 class="justify-text text-about">جی وان یک پروژه کوچیک و اوپن سورسه که برای رفع مشکل سایت های شخصیم نوشته شده که لینک مطالبی که به
                اشتراک گزاشته میشه کوتاه بشه در صورتی که سئو سایت اصلی خراب نشه. کوتاه کننده های لینک زیادن ولی فرقشون اینه که ارزش سئو رو برای خودشون
         ثبت میکنن. 
                </h6>     
            </div>
         </div>
    </div>
    ';
}

function getFooterCopyWriteText(){
    echo '
    <div class="footer-copyright">
        <div class="container">
            <a class="grey-text text-lighten-4 right" href="http://kamrosoft.ir">طراحی و اجرا کامروسافت</a>
            <div class="left">
                <a href="https://www.facebook.com/kamyar.geramiasl" class="waves-effect waves-light white-text"><i class="fa fa-facebook small"></i></a>
                <a href="https://www.linkedin.com/in/kamyar-gerami-33997b108/" class="waves-effect waves-light white-text"><i class="fa fa-linkedin small"></i></a>
                <a href="https://twitter.com/kamyar_gerami" class="waves-effect waves-light white-text"><i class="fa fa-twitter small"></i></a>
                <a href="https://www.instagram.com/kam2yar/" class="waves-effect waves-light white-text"><i class="fa fa-instagram small"></i></a>
                <a href="https://github.com/kamrosoft/ji1-shortener" class="waves-effect waves-light white-text"><i class="fa fa-github small"></i></a>
            </div>
        </div>
    </div>
    ';
}