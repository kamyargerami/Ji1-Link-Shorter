<header>
    <div class="slider">
        <ul class="slides">
            <li>
                <img src="../Assets/image/slider_header_1.jpg">
                <div class="caption center-align hide-on-small-and-down">
                    <h3 class="black-text bold">کوتاه کننده لینک جی وان</h3>
                </div>
            </li>
        </ul>
    </div>
    <div class="row" id="getInputMainFirstPageDiv">
        <form action="../Controller/shortner.php" method="post" id="shortnerForm">
            <div class="row col l8 offset-l2 m10 offset-m1 xl6 offset-xl3 s12">
                <div class="input-field col s7 l7 m7 xl7">
                    <input name="linkLong" type="text" class="validate" id="mainInputGetLongLink">
                    <label class="mainLable" for="mainInputGetLongLink">لینک خود را وارد کنید</label>
                </div>
                <div class="input-field col l2 m2 xl2 hide-on-small-only">
                    <button type="reset" id="resetMainInputFormToShort" class="btn red darken-2 btn-large" onclick="resetMainInput()"><i class="material-icons">refresh</i></button>
                </div>
                <div class="input-field col s5 l3 m3 xl3">
                    <button type="submit" id="submitMainInputFormToShort" class="btn red darken-4 btn-large" onclick="showResaultFromShortnerFile()">تولید کن</button>
                </div>
                <div class="col s12 m12 l12 lx12 left-align margin20Botton">
                    <a target="_blank" id="ShowShortLink"></a>
                </div>
            </div>
        </form>
    </div>
</header>