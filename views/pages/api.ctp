<div>
	<h3>シート一覧</h3>
	
	<p>http://tyage.sakura.ne.jp/akasheet/sheets/index/limit:[limit]/page:[page]/sort:[sort]/direction:[direction]/format:[format]</p>
	
	<div>
		<h4>オプション</h4>
		
		<table>
			<thead>
				<tr>
					<th>パラメータ名</th>
					<th>選択肢</th>
					<th>説明</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>limit</td>
					<td></td>
					<td>1ページ内の表示件数</td>
				</tr>
				<tr>
					<td>page</td>
					<td></td>
					<td>ページ番号</td>
				</tr>
				<tr>
					<td>sort</td>
					<td>[Sheet.created, Sheet.view]</td>
					<td>投稿時間順(Sheet.created)、表示回数順(Sheet.view)の切り替え</td>
				</tr>
				<tr>
					<td>direction</td>
					<td>[asc, desc]</td>
					<td>昇順(asc)、降順(desc)の切り替え</td>
				</tr>
				<tr>
					<td>format</td>
					<td>[xml, json]</td>
					<td>フォーマット</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<div>
		<h4>例</h4>
		
		<div>
			<p>http://tyage.sakura.ne.jp/akasheet/sheets/index/limit:5/page:2/sort:Sheet.created/direction:desc/format:json</p>
			<p>JSON形式で最近投稿されたシートの5件目～10件目を表示</p>
		</div>
	</div>
</div>

<div>
	<h3>シートの詳細</h3>
	
	<p>http://tyage.sakura.ne.jp/akasheet/sheets/view/[id]/format:[format]</p>
	
	<div>
		<h4>オプション</h4>
		
		<table>
			<thead>
				<tr>
					<th>パラメータ名</th>
					<th>選択肢</th>
					<th>説明</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>id</td>
					<td></td>
					<td>シートのID</td>
				</tr>
				<tr>
					<td>limit</td>
					<td></td>
					<td>1ページ内の表示件数</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<div>
		<h4>例</h4>
		
		<div>
			<p>http://tyage.sakura.ne.jp/akasheet/sheets/view/1/format:json</p>
			<p>JSON形式でID:1のシートを表示</p>
		</div>
	</div>
</div>