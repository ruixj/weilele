
<div class="container">
	<div class="weui_tab_bd">

		<div class="hd banner">
			<p style="padding: 15px;">为了让给您享受更好的服务，请您选择所在的社区</p>
		</div>

		<div style="width: 100%; height: 200px; display: none; overflow: hidden; position: relative; z-index: 0; background-color: rgb(243, 241, 236); color: rgb(0, 0, 0); text-align: left;" id="map">
		 
		</div>
 

		<div class="weui_panel weui_panel_access">
			<div class="weui_panel_bd">
				<div class="weui_media_box weui_media_text attach">
					<figure>
						<figcaption>你可能在的小区：
							<div id="villages"> </div>
							<p>如果没有你的社区请点击 <a href="javascript:;" data-target="#full" class="weui_btn weui_btn_mini weui_btn_default open-popup" style="float: right;">搜索</a></p>
						</figcaption>
					</figure>
				</div>
			</div>
		</div>

		<div class="weui_cells weui_cells_checkbox">
 
		</div>
				
				
		<input name="location_id" id="location_id" value="" type="hidden">
		<div class="weui_panel weui_panel_access box-panel" style="background-color: #f1f1f1;">
			<div class="weui_panel_bd">
				<div class="weui_media_box weui_media_text">
					<a href="javascript:;" class="weui_btn weui_btn_primary" id="submit">完成</a>
				</div>
			</div>
		</div>
 
		<div id="full" class="weui-popup-container" style="height: 100%;bottom: 0;">
			<div class="weui-popup-overlay"></div>
			<div class="weui-popup-modal pdb80">
				<div id="sch-box" class="sch-box">
					<input class="fr borderradius-3 sch-submit" onclick="searchAndLocate();" value="搜索" type="button">
					<div class="sch-input-cont">
						<input id="_search" class="borderradius-3 sch-input" placeholder="如：北京曙光里" type="text">

					</div>
				</div>
				<div class="serach-list">
					 
					<ul id="location_result"></ul>
				</div>
			</div>
		</div>
	</div>
 
</div>