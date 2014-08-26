@extends ('layouts.customer-base')

@section ('content')
<div class="container content-container content-no-header help-page">
    <div class="row">
        <div class="col-md-2">
            <div class="list-group sidebar" data-spy="affix" data-offset-top="90" data-offset-bottom="200">
                <a href="#beginner-guide" class="list-group-item active">
                    新手指南
                </a>
                <a href="#1" class="list-group-item">支付相关</a>
                <a href="#2" class="list-group-item">配送须知</a>
                <a href="#3" class="list-group-item">关于商品</a>
                <a href="#4" class="list-group-item">关于发票</a>
                <a href="#5" class="list-group-item">售后服务</a>
                <a href="#6" class="list-group-item">退换须知</a>

            </div>
        </div>
        <div class="col-md-10">
            <section id="beginner-guide">
                <div class="row feature">
                    <div class="col-sm-6">
                        <img src="/optimall/asset/img/features/showcase1.png" class="img-responsive" />
                    </div>
                    <div class="col-sm-6 info">
                        <h3>
                            <img src="/optimall/asset/img/features/features-ico1.png" />
                            为什么信赖目光之城
                        </h3>
                        <p>
                            目光之城是全国最IN 的时尚眼镜商城。我们相信眼镜不单是一件工具，更是一种时尚品味的象征。我们会用专业的Ecommerce管理服务经验和最先进的IT技术，依托国内外深厚的行业资源和众多优秀合作伙伴，引入欧美设计师品牌眼镜及领先的消费服务模式，以达到我们的核心优势：于 Ultimate User Experience 的无懈追求。
                        </p>
                    </div>
                </div>
                <div class="row feature">
                    <div class="col-sm-6 pic-right">
                        <img src="/optimall/asset/img/features/showcase2.png" class="pull-right img-responsive" />
                    </div>
                    <div class="col-sm-6 info info-left">
                        <h3>
                            <img src="/optimall/asset/img/features/features-ico2.png" />
                            Blog page included
                        </h3>
                        <p>
                            There are many variations of passages of Lorem Ipsum available, but the randomised words which don"t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn"t anything embarrassing hidden in the middle of text.
                        </p>
                    </div>                
                </div>
                <div class="row feature">
                    <div class="col-sm-6">
                        <img src="/optimall/asset/img/features/showcase3.png" class="img-responsive" />
                    </div>
                    <div class="col-sm-6 info">
                        <h3>
                            <img src="/optimall/asset/img/features/features-ico3.png" />
                            Simple and clean coming soon page
                        </h3>
                        <p>
                            There are many variations of passages of Lorem Ipsum available, but the randomised words which don"t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn"t anything embarrassing hidden in the middle of text.
                        </p>
                    </div>
                </div>
            </section>                        
        </div>
    </div>            
</div>
@stop

@section("script")
@parent
<script>

    /* smooth scroll css */
    var time = 1000;
    var offset = -100;
    $(function() {
        $(".help-page a[href*=#]:not([href=#])").click(function() {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
                if (target.length) {
                    $("html,body").animate({
                        scrollTop: target.offset().top + offset
                    }, time);
                    return false;
                }
            }
        });
    });

    $(".list-group .list-group-item").on("click", function() {
        $(".list-group .list-group-item").removeClass("active");
        $(this).addClass("active");
    });
</script>
@stop
