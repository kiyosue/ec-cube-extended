/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
// �e�E�B���h�E�̑��݊m�F
function fnIsopener() {
    var ua = navigator.userAgent;
    if( !!window.opener ) {
        if( ua.indexOf('MSIE 4')!=-1 && ua.indexOf('Win')!=-1 ) {
            return !window.opener.closed;
        } else {
        	return typeof window.opener.document == 'object';
        }
	} else {
		return false;
	}
}

// �X�֔ԍ����͌Ăяo��
function fnCallAddress(php_url, tagname1, tagname2, input1, input2) {
	zip1 = document.form1[tagname1].value;
	zip2 = document.form1[tagname2].value;
	
	if(zip1.length == 3 && zip2.length == 4) {
		url = php_url + "?zip1=" + zip1 + "&zip2=" + zip2 + "&input1=" + input1 + "&input2=" + input2;
		window.open(url,"nomenu","width=500,height=350,scrollbars=yes,resizable=yes,toolbar=no,location=no,directories=no,status=no");
	} else {
		alert("�X�֔ԍ��𐳂������͂��ĉ������B");
	}
}

// �X�֔ԍ����猟�������Z����n���B
function fnPutAddress(input1, input2) {
	// �e�E�B���h�E�̑��݊m�F
	if(fnIsopener()) {
		if(document.form1['state'].value != "") {
			// ���ڂɒl����͂���B
			state_id = document.form1['state'].value;
			town = document.form1['city'].value + document.form1['town'].value;
			window.opener.document.form1[input1].selectedIndex = state_id;
			window.opener.document.form1[input2].value = town;
		}
	} else {
		window.close();
	}		
}

function fnOpenNoMenu(URL) {
	window.open(URL,"nomenu","scrollbars=yes,resizable=yes,toolbar=no,location=no,directories=no,status=no");
}

function fnOpenWindow(URL,name,width,height) {
	window.open(URL,name,"width="+width+",height="+height+",scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no");
}

// �t�H�[�J�X�𓖂Ă�
function fnSetFocus(name) {
	if(document.form1[name]) {
		document.form1[name].focus();
	}
}

// �Z���N�g�{�b�N�X�ɍ��ڂ����蓖�Ă�B
function fnSetSelect(name1, name2, val) {
	sele1 = document.form1[name1]; 
	sele2 = document.form1[name2];
	
	if(sele1 && sele2) {
		index=sele1.selectedIndex;
		
		// �Z���N�g�{�b�N�X�̃N���A	
		count=sele2.options.length
		for(i = count; i >= 0; i--) {
			sele2.options[i]=null;
		}
		
		// �Z���N�g�{�b�N�X�ɒl�����蓖�Ă�
		len = lists[index].length
		for(i = 0; i < len; i++) {
			sele2.options[i]=new Option(lists[index][i], vals[index][i]);
			if(val != "" && vals[index][i] == val) {
				sele2.options[i].selected = true;
			}
		}
	}
}

// Enter�L�[���͂��L�����Z������B(IE�ɑΉ�)
function fnCancelEnter()
{
	if (gCssUA.indexOf("WIN") != -1 && gCssUA.indexOf("MSIE") != -1) {
		if (window.event.keyCode == 13)
		{
			return false;
		}
	}
	return true;
}

// ���[�h�ƃL�[���w�肵��SUBMIT���s���B
function fnModeSubmit(mode, keyname, keyid) {
	switch(mode) {
	case 'delete_category':
		if(!window.confirm('�I�������J�e�S���ƃJ�e�S�����̂��ׂẴJ�e�S�����폜���܂�')){
			return;
		}
		break;
	case 'delete':
		if(!window.confirm('��x�폜�����f�[�^�́A���ɖ߂��܂���B\n�폜���Ă��X�����ł����H')){
			return;
		}
		break;
	case 'confirm':
		if(!window.confirm('�o�^���Ă��X�����ł���')){
			return;
		}
		break;
	case 'delete_all':
		if(!window.confirm('�������ʂ����ׂč폜���Ă��X�����ł���')){
			return;
		}
		break;
	default:
		break;
	}
	document.form1['mode'].value = mode;
	if(keyname != "" && keyid != "") {
		document.form1[keyname].value = keyid;
	}
	document.form1.submit();
}

function fnFormModeSubmit(form, mode, keyname, keyid) {
	switch(mode) {
	case 'delete':
		if(!window.confirm('��x�폜�����f�[�^�́A���ɖ߂��܂���B\n�폜���Ă��X�����ł����H')){
			return;
		}
		break;
	case 'confirm':
		if(!window.confirm('�o�^���Ă��X�����ł���')){
			return;
		}
		break;
	case 'regist':
		if(!window.confirm('�o�^���Ă��X�����ł���')){
			return;
		}
		break;		
	default:
		break;
	}
	document.forms[form]['mode'].value = mode;
	if(keyname != "" && keyid != "") {
		document.forms[form][keyname].value = keyid;
	}
	document.forms[form].submit();
}

function fnSetFormSubmit(form, key, val) {
	document.forms[form][key].value = val;
	document.forms[form].submit();
	return false;
}

function fnSetFormVal(form, key, val) {
	document.forms[form][key].value = val;
}

function fnChangeAction(url) {
	document.form1.action = url;
}

// �y�[�W�i�r�Ŏg�p����
function fnNaviPage(pageno) {
	document.form1['pageno'].value = pageno;
	document.form1.submit();
}

function fnSearchPageNavi(pageno) {
	document.form1['pageno'].value = pageno;
	document.form1['mode'].value = 'search';
	document.form1.submit();
	}

	function fnSubmit(){
	document.form1.submit();
}

// �|�C���g���͐���
function fnCheckInputPoint() {
	if(document.form1['point_check']) {
		list = new Array(
						'use_point'
						);
	
		if(!document.form1['point_check'][0].checked) {
			color = "#dddddd";
			flag = true;
		} else {
			color = "";
			flag = false;
		}
		
		len = list.length
		for(i = 0; i < len; i++) {
			if(document.form1[list[i]]) {
				document.form1[list[i]].disabled = flag;
				document.form1[list[i]].style.backgroundColor = color;
			}
		}
	}
}

// �ʂ̂��͂�����͐���
function fnCheckInputDeliv() {
	if(!document.form1) {
		return;
	}
	if(document.form1['deliv_check']) {
		list = new Array(
						'deliv_name01',
						'deliv_name02',
						'deliv_kana01',
						'deliv_kana02',
						'deliv_pref',
						'deliv_zip01',
						'deliv_zip02',
						'deliv_addr01',
						'deliv_addr02',
						'deliv_tel01',
						'deliv_tel02',
						'deliv_tel03'
						);
	
		if(!document.form1['deliv_check'].checked) {
			fnChangeDisabled(list, '#dddddd');
		} else {
			fnChangeDisabled(list, '');
		}
	}
}


// �w��������o�^���͐���
function fnCheckInputMember() {
	if(document.form1['member_check']) {
		list = new Array(
						'password',
						'password_confirm',
						'reminder',
						'reminder_answer'
						);

		if(!document.form1['member_check'].checked) {
			fnChangeDisabled(list, '#dddddd');
		} else {
			fnChangeDisabled(list, '');
		}
	}
}

// �ŏ��ɐݒ肳��Ă����F��ۑ����Ă���
var g_savecolor = new Array();

function fnChangeDisabled(list, color) {
	len = list.length;
	
	for(i = 0; i < len; i++) {
		if(document.form1[list[i]]) {
			if(color == "") {
				// �L���ɂ���
				document.form1[list[i]].disabled = false;
				document.form1[list[i]].style.backgroundColor = g_savecolor[list[i]];
			} else {
				// �����ɂ���
				document.form1[list[i]].disabled = true;
				g_savecolor[list[i]] = document.form1[list[i]].style.backgroundColor;
				document.form1[list[i]].style.backgroundColor = color;//"#f0f0f0";	
			}			
		}
	}
}


// ���O�C�����̓��̓`�F�b�N
function fnCheckLogin(formname) {
	var lstitem = new Array();
	
	if(formname == 'login_mypage'){
	lstitem[0] = 'mypage_login_email';
	lstitem[1] = 'mypage_login_pass';
	}else{
	lstitem[0] = 'login_email';
	lstitem[1] = 'login_pass';
	}
	var max = lstitem.length;
	var errflg = false;
	var cnt = 0;
	
	//�@�K�{���ڂ̃`�F�b�N
	for(cnt = 0; cnt < max; cnt++) {
		if(document.forms[formname][lstitem[cnt]].value == "") {
			errflg = true;
			break;
		}
	}
	
	// �K�{���ڂ����͂���Ă��Ȃ��ꍇ	
	if(errflg == true) {
		alert('���[���A�h���X/�p�X���[�h����͂��ĉ������B');
		return false;
	}
}
	
// ���Ԃ̌v��
function fnPassTime(){
	end_time = new Date();
	time = end_time.getTime() - start_time.getTime();
	alert((time/1000));
}
start_time = new Date();

//�e�E�B���h�E�̃y�[�W��ύX����B
function fnUpdateParent(url) {
	// �e�E�B���h�E�̑��݊m�F
	if(fnIsopener()) {
		window.opener.location.href = url;
	} else {
		window.close();
	}		
}

//����̃L�[��SUBMIT����B
function fnKeySubmit(keyname, keyid) {
	if(keyname != "" && keyid != "") {
		document.form1[keyname].value = keyid;
	}
	document.form1.submit();
}

//���������J�E���g����B
//����1�F�t�H�[������
//����2�F�������J�E���g�Ώ�
//����3�F�J�E���g���ʊi�[�Ώ�
function fnCharCount(form,sch,cnt) {
	document.forms[form][cnt].value= document.forms[form][sch].value.length;
}


// �e�L�X�g�G���A�̃T�C�Y��ύX����
function ChangeSize(button, TextArea, Max, Min, row_tmp){
	
	if(TextArea.rows <= Min){
		TextArea.rows=Max; button.value="����������"; row_tmp.value=Max;
	}else{
		TextArea.rows =Min; button.value="�傫������"; row_tmp.value=Min;
	}
}

