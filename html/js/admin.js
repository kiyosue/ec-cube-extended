/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
// �Ǘ��҃����o�[��ǉ�����B
function fnRegistMember() {
	// �K�{���ڂ̖��O�A���O�C��ID�A�p�X���[�h�A����
	var lstitem = new Array();
	lstitem[0] = 'name';
	lstitem[1] = 'login_id';
	lstitem[2] = 'password';
	lstitem[3] = 'authority';
	
	var max = lstitem.length;
	var errflg = false;
	var cnt = 0;
	
	//�@�K�{���ڂ̃`�F�b�N
	for(cnt = 0; cnt < max; cnt++) {
		if(document.form1[lstitem[cnt]].value == "") {
			errflg = true;
			break;
		}
	}
	
	// �K�{���ڂ����͂���Ă��Ȃ��ꍇ	
	if(errflg == true) {
		alert('�K�{���ڂ���͂��ĉ������B');
		return false;
	} else {
		if(window.confirm('���e��o�^���Ă��X�����ł��傤��')){
			return true;
		} else {  
			return false;
		}
	}
}

//�e�E�B���h�E�̃y�[�W��ύX����B
function fnUpdateParent(url) {
	// �e�E�B���h�E�̑��݊m�F
	if(fnIsopener()) {
		window.opener.location.href = url;
	} else {
		window.close();
	}		
}

// �e�E�B���h�E���|�X�g������B
function fnSubmitParent() {
	// �e�E�B���h�E�̑��݊m�F
	if(fnIsopener()) {
		window.opener.document.form1.submit();
	} else {
		window.close();
	}		
}

//�w�肳�ꂽid�̍폜���s���y�[�W�����s����B
function fnDeleteMember(id, pageno) {
	url = "./delete.php?id=" + id + "&pageno=" + pageno;
	if(window.confirm('�o�^���e���폜���Ă��X�����ł��傤��')){
		location.href = url;
	}
}

// ���W�I�{�^���`�F�b�N��Ԃ�ۑ�
var lstsave = "";

// ���W�I�{�^���̃`�F�b�N��Ԃ��擾����B
function fnGetRadioChecked() {
	var max;
	var cnt;
	var names = "";
	var startname = "";
	var ret;
	max = document.form1.elements.length;
	lstsave = Array(max);
	for(cnt = 0; cnt < max; cnt++) {
		if(document.form1.elements[cnt].type == 'radio') {
			name = document.form1.elements[cnt].name;
			/* radio�{�^���͓������O���Q�񑱂��Č��o�����̂ŁA
			   �ŏ��̖��O�̌��o�ł��邩�ǂ����̔��� */
			// 1��ڂ̌��o
			if(startname != name) {
				startname = name;	
				ret = document.form1.elements[cnt].checked;
				if(ret == true){
					// �ғ����`�F�b�N����Ă���B
					lstsave[name] = 1;
				}	
			// 2��ڂ̌��o
			} else {
				ret = document.form1.elements[cnt].checked;
				if(ret == true){
					// ��ғ����`�F�b�N����Ă���B
					lstsave[name] = 0;
				}
			}
		}
	}
}

// ���W�I�{�^���ɕύX�������������肷��B
function fnChangeRadio(name, no, id, pageno) {
	// �ŏ��̎擾��Ԃ���ύX����̏ꍇ
	if(lstsave[name] != no) {
		// DB���f�y�[�W���s
		url = "./check.php?id=" + id + "&no=" + no + "&pageno=" + pageno;
		location.href = url;
	}
}

// �Ǘ��҃����o�[�y�[�W�̐ؑ�
function fnMemberPage(pageno) {
	location.href = "./index.php?pageno=" + pageno;
}

// �y�[�W�i�r�Ŏg�p����
function fnNaviSearchPage(pageno, mode) {
	document.form1['search_pageno'].value = pageno;
	document.form1['mode'].value = mode;
	document.form1.submit();
}

// �y�[�W�i�r�Ŏg�p����(mode = search��p)
function fnNaviSearchOnlyPage(pageno) {
	document.form1['search_pageno'].value = pageno;
	document.form1['mode'].value = 'search';
	document.form1.submit();
}

// �y�[�W�i�r�Ŏg�p����(form2)
function fnNaviSearchPage2(pageno) {
	document.form2['search_pageno'].value = pageno;
	document.form2['mode'].value = 'search';
	document.form2.submit();
}

// �l�������Ďw��y�[�W��submit
function fnSetvalAndSubmit( fname, key, val ) {
	fm = document[fname];
	fm[key].value = val;
	fm.submit();
}

// ���ڂɓ������l���N���A����B
function fnClearText(name) {
	document.form1[name].value = "";
}

// �J�e�S���̒ǉ�
function fnAddCat(cat_id) {
	if(window.confirm('�J�e�S����o�^���Ă��X�����ł��傤��')){
		document.form1['mode'].value = 'edit';
		document.form1['cat_id'].value = cat_id;
	}
}

// �J�e�S���̕ҏW
function fnEditCat(parent_id, cat_id) {
	document.form1['mode'].value = 'pre_edit';
	document.form1['parent_id'].value = parent_id;
	document.form1['edit_cat_id'].value = cat_id;
	document.form1.submit();
}

// �I���J�e�S���̃`�F�b�N
function fnCheckCat(obj) {
	val = obj[obj.selectedIndex].value;
	if (val == ""){
		alert ("�e�J�e�S���͑I���ł��܂���");
		obj.selectedIndex = 0;
	}
}

// �m�F�y�[�W����o�^�y�[�W�֖߂�
function fnReturnPage() {
	document.form1['mode'].value = 'return';
	document.form1.submit();
}

// �K�i���ޓo�^�ֈړ�
function fnClassCatPage(class_id) {
	location.href =  "./classcategory.php?class_id=" + class_id;
}

function fnSetFormValue(name, val) {
	document.form1[name].value = val;
}

function fnListCheck(list) {
	len = list.length;
	for(cnt = 0; cnt < len; cnt++) {
		document.form1[list[cnt]].checked = true;
	}
}

function fnAllCheck() {
	cnt = 1;
	name = "check:" + cnt;
	while (document.form1[name]) {
		document.form1[name].checked = true;
		cnt++;
		name = "check:" + cnt;
	}
}

function fnAllUnCheck() {
	cnt = 1;
	name = "check:" + cnt;
	while (document.form1[name]) {
		document.form1[name].checked = false;
		cnt++;
		name = "check:" + cnt;
	}
}

//�w�肳�ꂽid�̍폜���s���y�[�W�����s����B
function fnDelete(url) {
	if(window.confirm('�o�^���e���폜���Ă��X�����ł��傤��')){
		location.href = url;
	}
}

//�z����������������
function fnSetDelivFee(max) {
	for(cnt = 1; cnt <= max; cnt++) {
		name = "fee" + cnt;
		document.form1[name].value = document.form1['fee_all'].value;
	}
}

// �݌ɐ���������
function fnCheckStockLimit(icolor) {
	if(document.form1['stock_unlimited']) {
		list = new Array(
			'stock'
			);
		if(document.form1['stock_unlimited'].checked) {
			fnChangeDisabled(list, icolor);
			document.form1['stock'].value = "";
		} else {
			fnChangeDisabled(list, '');
		}
	}
}

// �݌ɐ���������
function fnCheckStockNoLimit(no, icolor) {
	$check_key = "stock_unlimited:"+no;
	$input_key = "stock:"+no;
	
	list = new Array($input_key	);
	if(document.form1[$check_key].checked) {
		fnChangeDisabled(list, icolor);
		document.form1[$input_key].value = "";
	} else {
		fnChangeDisabled(list, '');
	}
}

// �w������������
function fnCheckSaleLimit(icolor) {
	list = new Array(
		'sale_limit'
		);	
	if(document.form1['sale_unlimited'].checked) {
		fnChangeDisabled(list, icolor);
		document.form1['sale_limit'].value = "";
	} else {
		fnChangeDisabled(list, '');
	}
}

// �݌ɐ�����
function fnCheckAllStockLimit(max, icolor) {
	for(no = 1; no <= max; no++) {
		$check_key = "stock_unlimited:"+no;
		$input_key = "stock:"+no;
		
		list = new Array($input_key);
	
		if(document.form1[$check_key].checked) {
			fnChangeDisabled(list, icolor);
			document.form1[$input_key].value = "";
		} else {
			fnChangeDisabled(list, '');
		}
	}
}

// Form�w���Submit 
function fnFormSubmit(form) {
	document.forms[form].submit();
}

// �m�F���b�Z�[�W
function fnConfirm() {
	if(window.confirm('���̓��e�œo�^���Ă��X�����ł��傤��')){
		return true;
	}
	return false;
}

//�폜�m�F���b�Z�[�W
function fnDeleteConfirm() {
	if(window.confirm('�폜���Ă��X�����ł��傤��')){
		return true;
	}
	return false;
}

//�����}�K�`���ύX�m�F���b�Z�[�W
function fnmerumagaupdateConfirm() {
	if(window.confirm("���ɓo�^����Ă��郁�[���A�h���X�ł��B\n�����}�K�̎�ނ��ύX����܂��B�X�����ł����H")){
		return true;
	}
	return false;
}

// �t�H�[���ɑ�����Ă���T�u�~�b�g����B
function fnInsertValAndSubmit( fm, ele, val, msg ){
	
	if ( msg ){
		ret = window.confirm(msg);
	} else {
		ret = true;
	}
	if( ret ){
		fm[ele].value = val;
		fm.submit();
		return false;
	}
	return false;
}

// �����ȊO�̗v�f��L���E�����ɂ���
function fnSetDisabled ( f_name, e_name, flag ) {
	fm = document[f_name];
	
	//�@�K�{���ڂ̃`�F�b�N
	for(cnt = 0; cnt < fm.elements.length; cnt++) {
		if( fm[cnt].name != e_name && fm[cnt].name != 'subm' && fm[cnt].name != 'mode') {
			fm[cnt].disabled = flag;
			if ( flag == true ){
				fm[cnt].style.backgroundColor = "#cccccc";
			} else {
				fm[cnt].style.backgroundColor = "#ffffff";
			}
		}
	}
}


//���X�g�{�b�N�X���̍��ڂ��ړ�����
function fnMoveCat(sel1, sel2, mode_name) {
	var fm = document.form1;
	for(i = 0; i < fm[sel1].length; i++) {
		if(fm[sel1].options[i].selected) {
			if(fm[sel2].value != "") {
				fm[sel2].value += "-" + fm[sel1].options[i].value;
			} else {
				fm[sel2].value = fm[sel1].options[i].value;
			}
		}
	}
	fm["mode"].value = mode_name;
	fm.submit();
}

//���X�g�{�b�N�X���̍��ڂ��폜����
function fnDelListContents(sel1, sel2, mode_name) {
	fm = document.form1;
	for(j = 0; j < fm[sel1].length; j++) {
		if(fm[sel1].options[i].selected) {
			fm[sel2].value = fm[sel2].value.replace(fm[sel1].options[i].value, "");
		}
	}
	
	fm["mode"].value = mode_name;
	fm.submit();
}

//��s�ڂ̉��i���ȉ��̍s�ɃR�s�[����
function fnCopyValue(length, icolor) {
	fm = document.form1;
	for(i = 1; i <= length; i++) {
		fm['product_code:' + i].value = fm['product_code:1'].value;
		fm['stock:' + i].value = fm['stock:1'].value;
		fm['price01:' + i].value = fm['price01:1'].value;
		fm['price02:' + i].value = fm['price02:1'].value;
		fm['stock_unlimited:' + i].checked = fm['stock_unlimited:1'].checked;
		fm['stock:' + i].disabled = fm['stock:1'].disabled;		
		fm['stock:' + i].style.backgroundColor = fm['stock:1'].style.backgroundColor;
	}	
}

// �^�O�̕\����\���؂�ւ�
function fnDispChange(disp_id, inner_id, disp_flg){
	disp_state = document.getElementById(disp_id).style.display;
	
	if (disp_state == "") {
		document.form1[disp_flg].value="none";
		document.getElementById(disp_id).style.display="none";
		document.getElementById(inner_id).innerHTML = '<FONT Color="#FFFF99"> << �\�� </FONT>';
	}else{
		document.form1[disp_flg].value="";
		document.getElementById(disp_id).style.display="";
		document.getElementById(inner_id).innerHTML = ' <FONT Color="#FFFF99"> >> ��\�� </FONT>'; 
	}
}



	