@extends ('layouts.base')

@section('content')
<div class="container content-container">	
	<a href="{{ action('MemberAccountController@getAmbassadorPanel') }}">
		{{ HTML::image('images/ambassador/call-to-action.jpg') }}
	</a>

	<!--detailed product info -->
	<ul class="nav nav-tabs ambassador-tabs" role="tablist">
		<li class="active">
			<a href="#about_ambassador"  role="tab" data-toggle="tab">
				什么是目光之星
			</a>
		</li>
		<li>
			<a href="#how_it_works" role="tab" data-toggle="tab">
				活动规则
			</a>
		</li>
		<li>
			<a href="#how_to_earn" role="tab" data-toggle="tab">
				如何返利
			</a>
		</li>
		<li>
			<a href="#terms_condition" role="tab" data-toggle="tab">
				条款协议
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active tab-pane-bordered" id="about_ambassador">
			<div class="row">
				<div class="col-md-12">     
					<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" data-original="{{ asset('images/ambassador/program-introduction.jpg') }}" class="lazy">
				</div>
			</div> 
		</div>

		<div class="tab-pane fade tab-pane-bordered" id="how_it_works">
			<div class="row">
				<div class="col-md-12">     
					<img src="{{ asset(Config::get('optimall.lazyloadImg')) }}" data-original="{{ asset('images/ambassador/ambassador-illustration.jpg') }}" class="lazy">
				</div>
			</div>            
		</div>


		<div class="tab-pane fade tab-pane-bordered" id="how_to_earn">

		</div>

		<div class="tab-pane fade tab-pane-bordered" id="terms_condition">
			<div class="row">
				<div class="col-md-12 padding-40">     
					<p>目光之城运行并维护本网站，对此次促销活动负责并保有最终解释权。浏览本网站之前，请务必仔细阅读本条款和条件。当您使用本网站时，请确认您同意并接受以下条款和条件。 您可以下载网站上的资源并用于个人,非商业目的。此外，在未得到目光之城的书面许可前，您不得修改，复制， 或使用本网站的内容（包括文本，图像，音频和视频。）于公共或商业用途。 目光之城保留在任何时间取消或修改本网站的促销活动和本条款和条件的权利。任何更改都将在本网站或条款和条件内公布，恕不另行通知。</p>
					<br>
					<h5><strong>条款</strong></h5>
					<p>促销代码只适用于每一个新客户的第一个订单。 20％的现金返利只适用于每个新客户的第一个订单。目光之星将获得同一个客户后续（第一笔订单之后60天之内）订单金额10％的现金返利。每个成功的订单的现金返利最高为50。目光之星需要积累至少50的返利金额才可以兑现。成功兑现的金额将在7个工作日内发放。现金返利会在获得一年后过期。 目光之星不得在除去个人社交平台或个人网站之外的公共场所发布促销代码 。鉴于目光之城的30天免费退货政策，现金返利将在订单成功结算的40天后支付。如果客户取消/申请退款的订单，与该笔订单相关的返利将被取消。任何欺诈行为将会被严厉追究。 ZALORA不会对目光之星的宣传及一切相关活动承担责任。目光之城将保留终止与目光之星的合作或在合理情况内拒绝支付的权利。</p>
					<br>
					<h5><strong>责任</strong></h5>
					<p>目光之城不承担任何因参与活动或接受返利而对活动参与者造成的损害，损失，伤害或精神损失。目光之城不承担任何与电话网络或线路，网络服务， 计算机设备等技术故障或因下载本网站资源而造成的一切损失，人身伤害及后果。</p>
					<p>当您参与本活动或接受返利的时候，您已同意将不会对目光之城，其母公司，关联公司，董事，管理人员，代理或员工进行有关损失或人身伤害的申索（包括特殊及间接损失）。 </p>
					<br>
					<h5><strong>个人信息使用</strong></h5>
					<p>在您参活动的时候，您同意目光之城：</p>
					<p>无偿使用您的姓名和/或肖像，进行宣传和营销。</p>
					<p>无偿使用活动者注册时提供的信息，进行宣传和营销。</p>
					<p>无偿使用你在网页上回答问题的答案，进行宣传和营销。</p>
					<p>目光之城及其附属公司尊重每一个网站访客和广告宣传参与者的隐私。</p>
					<br>
					<h5><strong>隐私条款</strong></h5>
					<p>信息 – 在您使用网站时，您可能会被要求输入信息。该信息将只用于网站说明的目的，并且 按照本隐私条款。 </p>
					<p>第三方信息共享 - 我们不会出售或以任何未经您同意的方式把资料转移给不相关的第三方。在适用的情况下，您将有机会表明您是否同意接受目光之城或其他第三方关于产品，服务和促销活动的宣传和/或销售信息。 </p>			
					<p>用户行为分析 - 我们保留对用户行为及特征（包括用户对网站各领域的使用及兴趣）进行数据分析，并将此类信息以及用户对商品的曝光率和点击量告知广告刊登者/生产商的权利。我们将只会提供汇总数据给第三方。我们不对任何与第三方索求个人信息的行为负责，您应该自行检查适用的第三方隐私政策与条款。</p>
					<p>缓存 – 您应当知道当您浏览目光之城网页的时候，信息和数据可能会因为缓存被自动收集。缓存是小的文本文件，目光之城可以用它来识别重复的用户，观察用户的行为，并编制汇总数据，以此来改善网站和广告信息。 缓存不会影响您的电脑系统，也不会损坏你的文件。如果您不想通过缓存被收集信息，在大多数浏览器软件中您都可以选择拒绝或接受缓存功能。 </p>
					<p>更新或删除信息 -如果您对以前提供的信息需要做出任何更新，修改或更正， 您可以通过网站上的反馈表通知我们。 此外，如果您有要求，我们将在合理的商业范围内尽最大的努力将您的信息从我们的数据库中删除（在任何情况下信息删除将会在十（10）个工作日内完成）。然而，因为备份和删除记录的原因，目光之城可能会保留一些残余信息。 </p>
					<p>条款更新/修正 - 我们保留在任何时间修改，变更或更新本隐私条款的权利。如有任何变化，我们将会及时通知您。</p>
					
				</div>
			</div> 
			

		</div>

	</div>


</div>
@stop

@section('link-script')
@parent
@stop


@section('script')
@parent
<script type="text/javascript">
</script>
@stop