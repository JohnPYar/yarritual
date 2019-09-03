<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class="list">
				<thead>
				<tr>
					<td class="left" style="width: 45%"><?php echo $column_query; ?></td>
					<td class="left" style="width: 45%"><?php echo $column_keyword; ?></td>
					<td class="right" ><?php echo $column_action; ?></td>
				</tr>
				</thead>
				<tbody>
				<tr id="new">
					<td class="left"><input type="text" value="" name="query"/></td>
					<td class="left"><input type="text" value="" name="keyword"/></td>
					<td class="right"><a class="button" onclick="saveAlias('new')"><?php echo $button_add; ?></a></td>
				</tr>
				<?php foreach($aliases as $alias) { ?>
				<tr id="<?php echo $alias['url_alias_id']; ?>">
					<input type="hidden" value="<?php echo $alias['url_alias_id']; ?>" name="url_alias_id"/>
					<td class="left"><input style="display: none;" type="text" value="<?php echo $alias['query']; ?>" name="query"/> <span><?php echo $alias['query']; ?></span></td>
					<td class="left"><input style="display: none;" type="text" value="<?php echo $alias['keyword']; ?>" name="keyword"/><span><?php echo $alias['keyword']; ?></span></td>
					<td class="right">[
						<a onclick="editAlias(<?php echo $alias['url_alias_id']; ?>)"><?php echo $text_edit; ?></a>
						<a onclick="deleteAlias(<?php echo $alias['url_alias_id']; ?>)"><?php echo $text_delete; ?></a>
						<a style="display: none;" onclick="saveAlias(<?php echo $alias['url_alias_id']; ?>)"><?php echo $text_save; ?></a>
						<a style="display: none;" onclick="cancelAlias(<?php echo $alias['url_alias_id']; ?>)"><?php echo $text_cancel; ?></a>
						]
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</form>
	</div>
  </div>

	<script type="text/javascript"><!--
	function deleteAlias(id) {
		$.ajax({
			url:'<?php echo $delete_ajax; ?>',
			data:$('#' + id + " input"),
			dataType:'json',
			type:"POST",
			success:function (g) {
				$('#' + id).remove();
			}
		});
	}
	function saveAlias(id) {
		$.ajax({
			url:'<?php echo $save_ajax; ?>',
			data:$('#' + id + " input"),
			dataType:'json',
			type:"POST",
			success:function (g) {
				if (id == 'new') {
					query = $('#' + id + " input:eq(0)").val();
					keyword = $('#' + id + " input:eq(1)").val();
					html = '<tr id="' + g.result + '">' +
							'<input type="hidden" value="' + g.result + '" name="url_alias_id"/>' +
							'<td class="left"><input style="display: none;" type="text" value="' + query + '" name="query"/> <span>' + query + '</span></td>' +
							'<td class="left"><input style="display: none;" type="text" value="' + keyword + '" name="keyword"/><span>' + keyword + '</span></td>' +
							'<td class="right">[' +
							'<a onclick="editAlias(' + g.result + ')"><?php echo $text_edit; ?></a> ' +
							'<a onclick="deleteAlias(' + g.result + ')"><?php echo $text_delete; ?></a> ' +
							'<a style="display: none;" onclick="saveAlias(' + g.result + ')"><?php echo $text_save; ?></a> ' +
							'<a style="display: none;" onclick="cancelAlias(' + g.result + ')"><?php echo $text_cancel; ?></a> ' +
							']' +
							'</td>' +
							'</tr>';
					$('table.list').append(html);
				} else {
					$('#' + id + " span:eq(0)").text($('#' + id + " input:eq(1)").val());
					$('#' + id + " span:eq(1)").text($('#' + id + " input:eq(2)").val());
					$('#' + id + " input").toggle();
					$('#' + id + " span").toggle();
					$('#' + id + " a").toggle();
				}
			}
		});
	}
	function cancelAlias(id) {
		$('#' + id + " input").toggle();
		$('#' + id + " span").toggle();
		$('#' + id + " a").toggle();
	}
	function editAlias(id) {
		$('#' + id + " input").toggle();
		$('#' + id + " span").toggle();

		$('#' + id + " a").toggle();
	}
	//--></script>
	copyright &copy; <a href="mailto:ruslan.shv@gmail.com">Ruslan Shvarev</a>
</div>
<?php echo $footer; ?>
