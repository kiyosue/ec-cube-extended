/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
// �T�C�Y�Ǘ��N���X�̒�`
function SC_Size() {
	this.id = '';				// ID
	this.left = 0;				// �z�u����Y�����W
	this.top = 0;				// �z�u����X�����W
	this.width = 0;				// �I�u�W�F�N�g�̕�
	this.height = 0;			// �I�u�W�F�N�g�̍���
	this.target_id = '';		// �z�u�ꏊ�i���i�r�Ƃ��j
	this.margin = 10;			// ��̃I�u�W�F�N�g�Ƃ̕�
	this.obj;
};

// �ϐ��錾
var defUnused = 500;	// ���g�p�̈�̃f�t�H���g�̍���
var defNavi   = 400;	// ���E�i�r�̃f�t�H���g�̍���
var defMainNavi  = 100;	// ���C���㉺�̃f�t�H���g�̍���
var defMain   = 200;	// ���C���̃f�t�H���g�̍���

var NowMaxHeight = 0;		// ���݂̍ő�̍���
var MainHeight = 200;

var marginUnused 	= 688;	// ���g�p�̈�̍��}�[�W��
var marginLeftNavi  = 180;	// ���i�r�̍��}�[�W��
var marginRightNavi = 512;	// �E�i�r�̍��}�[�W��
var marginMain		= 348;	// ���C���㉺�̍��}�[�W��
var marginMainFootTop= 595;	// ���C�����̏�}�[�W��

var gDragged = "";			// �h���b�O���I�u�W�F�N�g
var gDropTarget = "";		// �h���b�O�J�n����DropTarget

var arrObj = new Object();	// �u���b�N�I�u�W�F�N�g�i�[�p

var mouseFlg = false;

var all_elms;				// div�^�O�I�u�W�F�N�g�i�[�p

// �E�B���h�E�T�C�Y
var scrX;
var scrY;

// �C�x���g�̊֘A�t�����s��
function addEvent( elm, evtType, fn, useCapture) {

    if (elm.addEventListener) {
        elm.addEventListener(evtType, fn, useCapture);
        return true;

    }
    else if (elm.attachEvent) {

        var r = elm.attachEvent('on' + evtType, fn);
        return r;

    }
    else {
        elm['on'+evtType] = fn;

    }
    
}


// �C�x���g�̊֘A�t��������
function removeEvent( elm, evtType, fn, useCapture) {

    if (elm.removeEventListener) {

        elm.removeEventListener(evtType, fn, useCapture);
        return true;

    }
    else if (elm.detachEvent) {

        var r = elm.detachEvent('on' + evtType, fn);
        return r;

    }
    else {

        elm['on'+evtType] = fn;

    }
   
}

// �}�E�X�J�[�\����ύX
function setCursor ( elm, curtype ) {
	elm.style.cursor = curtype;
}

// �I�u�W�F�N�g�̓����x��ύX   
function setOpacity(node,val) {

    if (node.filters) {
		node.filters["alpha"].opacity = val*100;
    } else if (node.style.opacity) {
        node.style.opacity = val;
    }
}

// Zindex��ύX����i�O�ʕ\���ؑցj
function setZindex(node, val) {
	node.style.zIndex = val;
//	alert(val);
}

// �l���擾
function getAttrValue ( elm, attrname ) {

	if (typeof(elm.attributes[ attrname ]) != 'undefined') {
	    return elm.attributes[ attrname ].nodeValue;
	}

/*
//	if (typeof(elm.attributes.getNamedItem(attrname)) != 'object'){
		val = "";
		if((typeof ScriptEngineMajorVersion)=='function')
		{
			if( Math.floor(ScriptEngineMajorVersion()) == 5 &&
				navigator.userAgent.indexOf("Win")!=-1) //win-e5�Ή�
				{
				val = elm.attributes.item(attrname)
				}
			else
			{
				val = elm.attributes.getNamedItem(attrname)
			}
		} else {
			val = elm.attributes.getNamedItem(attrname)
		}
		
		alert(val.value);
		
		return val.value;
//	}
*/
}

// �l���Z�b�g
function setAttrValue ( elm, attrname, val ) {
    elm.attributes[ attrname ].nodeValue = val;
}

// �I�u�W�F�N�g��X���W���擾
function getX ( elm ) {
//   return parseInt(elm.style.left);
	return parseInt(elm.offsetLeft);
}

// �I�u�W�F�N�g��Y���W���擾
function getY ( elm ) {
	return parseInt(elm.offsetTop);
//    return parseInt(elm.style.top);
}

// X���W���擾
function getEventX ( evt ) {
    return evt.clientX ? evt.clientX : evt.pageX;
}

// Y���W���擾
function getEventY ( evt ) {
    return evt.clientY ? evt.clientY : evt.pageY;
}

// �I�u�W�F�N�g�̕����擾
function getWidth ( elm ) {
    return parseInt( elm.style.width );
}

// �I�u�W�F�N�g�̍������擾
function getHeight ( elm ) {
//    return parseInt( elm.style.height );
    return parseInt( elm.offsetHeight );
}

// �y�[�W�̉��̈��X���W���擾����
function getPageScrollX()
{
	var x = 0;

	if (document.body && document.body.scrollLeft != null) {
		x = document.body.scrollLeft;
	} else if (document.documentElement && document.documentElement.scrollLeft != null) {
		x = document.documentElement.scrollLeft;
	} else if (window.scrollX != null) {
		x = window.scrollX;
	} else if (window.pageXOffset != null) {
		x = window.pageXOffset;
	}
	
	return x;
}

// �y�[�W�̉��̈��Y���W���擾����
function getPageScrollY()
{
	var y = 0;
	
	if (document.body && document.body.scrollTop != null) {
		y = document.body.scrollTop;
	} else if (document.documentElement && document.documentElement.scrollTop != null) {
		y = document.documentElement.scrollTop;
	} else if (window.scrollY != null) {
		y = window.scrollY;
	} else if (window.pageYOffset != null) {
		y = window.pageYOffset;
	}
	
	return y;
}


// �I�u�W�F�N�g�̍��W���Z�b�g
function moveElm ( elm, x, y ) {
    elm.style.left = x + 'px';
    elm.style.top = y + 'px';
}

// �}�E�X�_�E���C�x���g
function onMouseDown (evt) {

    var target = evt.target ? evt.target : evt.srcElement;
    var x = getEventX ( evt );
    var y = getEventY ( evt );

    //
    // Save Information to Globals
    //
  	if (mouseFlg == false) {
    
	    gDragged = target;
	
	    gDeltaX = x - getX(gDragged);
	    gDeltaY = y - getY(gDragged);
	
	    gDraggedId = getAttrValue ( gDragged, 'did' );
	    setCursor ( gDragged, 'move' );
	
	    gOrgX = getX ( gDragged );
	    gOrgY = getY ( gDragged );
	    gtarget_id = getAttrValue ( gDragged, 'target_id' );
	
	    //
	    // Set
	    //
	   
	    // �h���b�O���͔�����
	    setOpacity ( gDragged, 0.6 );
	
	    // �h���b�O���͍őO�ʕ\��
	    setZindex ( gDragged , 2);
	    
	    addEvent ( document, 'mousemove', onMouseMove, false );
	    addEvent ( document, 'mouseup', onMouseUp, false );

	    // �h���b�O���J�n�����Ƃ��͍�������x����������B
	    NowMaxHeight = defNavi;
	    	    
	    mouseFlg = true;
	}
}


// �}�E�X���[�u�C�x���g
function onMouseMove(evt) {

	// ���݂̍��W���擾
	var x = getEventX ( evt ) + document.body.scrollLeft;					// �}�E�X���W X
	var y = getEventY ( evt ) + document.body.scrollTop;					// �}�E�X���W Y
    var nowleft = getEventX ( evt ) - gDeltaX;	// �I�u�W�F�N�g���W LEFT
    var nowtop = getEventY ( evt ) - gDeltaY;	// �I�u�W�F�N�g���W TOP

    // �I�u�W�F�N�g���ړ�
    moveElm ( gDragged, nowleft, nowtop );
	
    for ( var i = 0; i < all_elms.length; i++ ) {
    	// drop_target��ɂ����ꍇ�ɂ̂ݏ������s��
	    if ( isEventOnElm ( evt, all_elms[i].id ) ) {	    
            if ( all_elms[i].attributes['tid'] ) {
	            var tid = getAttrValue ( all_elms[i], 'tid' );
	            
	            // �w�i�F�̕ύX ���g�p�̈�͕ύX���Ȃ�
	            all_elms[i].style.background="#ffffdd";
	            
				// target_id �̏�������
		        setAttrValue ( gDragged, 'target_id', tid );

				//objCheckLine.style.top = parseInt(nowtop) + parseInt(gDragged.style.height) / 2 + 'px';
				//objCheckLine.style.top = y;

				// �z��̍č쐬
				fnCreateArr(1, y, x);
				// �z��̕��ёւ�
				fnChangeObj(tid);
		    }
		}else{
			if ( all_elms[i].attributes['tid'] && all_elms[i].style.background!="#ffffff") {
				// �w�i�F�̕ύX
				all_elms[i].style.background="#ffffff";
			}
		}
    }
}

// �}�E�X�A�b�v�C�x���g       
function onMouseUp(evt) {
	// �C�x���g�̊֘A�t������
	if (mouseFlg == true) {
	    removeEvent ( document, 'mousemove', onMouseMove, false );
	    removeEvent ( document, 'mouseup', onMouseUp, false );
	    mouseFlg = false;
	}

    if ( !isOnDropTarget (evt) ) {
		// ���̈ʒu�ɖ߂�
        moveElm ( gDragged, gOrgX, gOrgY );
        setAttrValue ( gDragged, 'target_id', gtarget_id );

		// �z��̍č쐬
		fnCreateArr(1, gOrgY, gOrgX);
    }
    
    // hidden�v�f�̏�������
	var did = getAttrValue( gDragged, 'did' );
	var target_id = "target_id_"+did;
	document.form1[target_id].value = getAttrValue( gDragged, 'target_id' );
	
	// �������A�}�E�X�|�C���^�A�őO�ʏ�����߂�
    setOpacity( gDragged, 1);
    setCursor ( gDragged, 'move' );
    setZindex ( gDragged , 1);
    
    // ���ёւ�
	fnSortObj();
	
	// �w�i�F��߂�
	for ( var i = 0; i < all_elms.length; i++ ) {
    	// drop_target��ɂ����ꍇ�ɂ̂ݏ������s��
	    if ( isEventOnElm ( evt, all_elms[i].id ) && all_elms[i].attributes['tid']) {
			// �w�i�F�̕ύX
			all_elms[i].style.background="#ffffff";
		}
    }
}

// DropTarget��ɃI�u�W�F�N�g���������𔻒f����
function isOnDropTarget ( evt ) {
   
    for ( var i=0; i<all_elms.length; i++ ) {
        if ( isEventOnElm ( evt, all_elms[i].id ) ) {
            if ( all_elms[i].attributes['tid'] ) {
                return true;
            }
        }
    }
    return false;
}
function isEventOnElm (evt, drop_target_id) {

	if (drop_target_id == '') {
		return '';
	}

    var evtX = getEventX(evt) + getPageScrollX();
    var evtY = getEventY(evt) + getPageScrollY();
    
    var drop_target = document.getElementById( drop_target_id );

	drp_left = getX( drop_target );
	drp_top = getY( drop_target );

    var x = drp_left;
    var y = drp_top;

	var width = getWidth ( drop_target );
	var height = getHeight ( drop_target );
    
//	alert(evtX +" / "+ x +" / "+ evtY +" / "+ y +" / "+ width +" / "+ height);

    return evtX > x && evtY > y && evtX < x + width && evtY < y + height;
}

// �I�u�W�F�N�g�̕��ёւ����s��
function fnSortObj(){
	fnSetTargetHeight();
    for ( var cnt = 0; cnt < all_elms.length; cnt++ ) {

		// class�� drop_target �̏ꍇ�̂ݏ������s��
        if ( getAttrValue ( all_elms[cnt], 'class' ) == 'drop_target' ) {
        	var tid = getAttrValue ( all_elms[cnt], 'tid' );
			
			// �z��̕��ёւ�
			fnChangeObj(tid);
			
			// �z�u
			fnSetObj( tid, cnt );
        }
	}
}

function alerttest(msg, x, y){
 	alert(msg);
}

// �z��̍쐬
function fnCreateArr( addEvt , top , left ){

	var arrObjtmp = new Object();
	arrObjtmp['LeftNavi'] = Array();
	arrObjtmp['RightNavi'] = Array();
	arrObjtmp['MainHead'] = Array();
	arrObjtmp['MainFoot'] = Array();
	arrObjtmp['Unused'] = Array();

	for ( var i = 1; i < all_elms.length; i++ ) {
		// class�� dragged_elm �̏ꍇ�̂ݏ������s��
		if ( getAttrValue ( all_elms[i], 'class' ) == 'dragged_elm' ) {
        
			// �}�E�X�_�E���C�x���g�Ɗ֘A�t�����s��
			if (addEvt == 0) {
	        	addEvent ( all_elms[i], 'mousedown', onMouseDown, false );
			}

			var target_id = getAttrValue ( all_elms[i], 'target_id' );	
			var len = arrObjtmp[target_id].length;
			var did = getAttrValue ( all_elms[i], 'did' );
			
			arrObjtmp[target_id][len] = new SC_Size();
			arrObjtmp[target_id][len].id = did;
			arrObjtmp[target_id][len].obj = all_elms[i];
			arrObjtmp[target_id][len].width = getWidth( all_elms[i] );
			arrObjtmp[target_id][len].height = getHeight( all_elms[i] );

			// �h���b�O���̃I�u�W�F�N�g�����݂���΁A���̃I�u�W�F�N�g�����}�E�X�|�C���^�̍��W���w�肷��B
			if (gDragged != "") {
				if (did != getAttrValue ( gDragged, 'did' )) {
					// top �͏�ɃI�u�W�F�N�g�̒��S���擾����悤�ɂ���
					arrObjtmp[target_id][len].top = (parseInt(getY( all_elms[i] )) + arrObjtmp[target_id][len].height / 2 );
					arrObjtmp[target_id][len].left = getX( all_elms[i] );
				}else {
					arrObjtmp[target_id][len].top = top;
					arrObjtmp[target_id][len].left = left;
				}
			} else {
				// top �͏�ɃI�u�W�F�N�g�̒��S���擾����悤�ɂ���
				arrObjtmp[target_id][len].top = i;
				arrObjtmp[target_id][len].left = getX( all_elms[i] );
			}
		}
    }
    
    arrObj = arrObjtmp;
}

// �z��̕��ёւ� (�o�u���\�[�g�ŕ��ёւ����s��) 
function fnChangeObj( tid ){
	for ( var i = 0; i < arrObj[tid].length-1; i++ ) {
    	for ( var j = arrObj[tid].length-1; j > i; j-- ) {
			if ( arrObj[tid][j].top < arrObj[tid][i].top ) {
				var arrTemp = new Array();
				arrTemp = arrObj[tid][j];
				arrObj[tid][j] = arrObj[tid][i];
				arrObj[tid][i] = arrTemp;
			}
		}
	}
}

// �z�u
function fnSetObj( tid, cnt ){
	var target_height = 0;
	
	drp_left = getX(all_elms[cnt]); //all_elms[cnt].offsetLeft;
	drp_top = getY(all_elms[cnt]); //all_elms[cnt].offsetTop;

	for ( var j = 0; j < arrObj[tid].length; j++ ) {
		// �z�u������W�̎擾
	    var left = parseInt(drp_left) + parseInt(all_elms[cnt].style.width) / 2 - parseInt(arrObj[tid][j].width) / 2;
	    if (j == 0){
	    	var top = drp_top + arrObj[tid][j].margin;
	    }else{
	    	var top = arrObj[tid][j-1].top + arrObj[tid][j].margin + arrObj[tid][j-1].height
	    }

		// ���W��ێ�
		arrObj[tid][j].top = top;
		arrObj[tid][j].left = left;

		// �z�u���s��
		moveElm ( arrObj[tid][j].obj, left ,top);

		// �����v�Z
		target_height = target_height + arrObj[tid][j].margin + arrObj[tid][j].height;

		// hidden�̒l����������
		var top_id = "top_" + arrObj[tid][j].id;
		document.form1[top_id].value = top;

	}
}

// �h���b�v�^�[�Q�b�g�̍�������
function fnSetTargetHeight(){

	var NaviHeight = defNavi;
	var MainHeadHeight = defMainNavi;
	var MainFootHeight = defMainNavi;
	var UnusedHeight = defUnused;

	// �����v�Z
    for ( var cnt = 0; cnt < all_elms.length; cnt++ ) {
		var target_height = 0;
    
		// class�� drop_target �̏ꍇ�̂ݏ������s��
        if ( getAttrValue ( all_elms[cnt], 'class' ) == 'drop_target' ) {
        	var tid = getAttrValue ( all_elms[cnt], 'tid' );

			for ( var j = 0; j < arrObj[tid].length; j++ ) {
				target_height = target_height + arrObj[tid][j].margin + arrObj[tid][j].height;
			}

			// ���̕�
			target_height = target_height + 20;

			// ���E�i�r�A���g�p�̈�̍�����ێ�
			if (tid == 'LeftNavi' || tid == 'RightNavi' || tid == 'Unused') {
				if (NaviHeight < target_height) {
					NaviHeight = target_height;
				}
			}

			// ���C���㕔�̈�̍�����ێ�
			if (tid == 'MainHead') {
				if (target_height > defMainNavi) {
					MainHeadHeight = target_height;
				}
			}

			// ���C�������̈�̍�����ێ�
			if (tid == 'MainFoot') {
				if (target_height > defMainNavi) {
					MainFootHeight = target_height;
				}
			}	
        }
	}

	// ���C���̈�̍�����ێ�
//	alert(NaviHeight+"/"+MainHeadHeight+"/"+MainFootHeight);
	MainHeight = NaviHeight - ( MainHeadHeight + MainFootHeight );
	if (MainHeight < defMain) {
		MainHeight = defMain;
	}

	// ���C�������̂ق����傫���ꍇ�ɂ͍��E�i�r���傫������
	if (NaviHeight < MainHeadHeight + MainFootHeight + MainHeight) {
		NaviHeight = MainHeadHeight + MainFootHeight + MainHeight;	
	}
	// �ύX
    for ( var cnt = 0; cnt < all_elms.length; cnt++ ) {
    	var target_height = 0;

		// class�� drop_target �̏ꍇ�̂ݏ������s��
        if ( getAttrValue ( all_elms[cnt], 'class' ) == 'drop_target' ) {
        	var tid = getAttrValue ( all_elms[cnt], 'tid' );
        	
        	// tid�ɂ���ď����𕪂���
			if (tid == 'LeftNavi' || tid == 'RightNavi') {
				target_height = NaviHeight;
			}else if (tid == 'MainHead' ) {
				target_height = MainHeadHeight;
			}else if (tid == 'MainFoot') {
				target_height = MainFootHeight;
			}else if (tid == 'Unused'){
				target_height = NaviHeight+100;
			}

			all_elms[cnt].style.height = target_height;
		}
	}
	
	// ���C���e�[�u���̍������ύX
    for (var i = 0; i < all_td.length; i++) {
    	name = getAttrValue ( all_td[i], 'name' );
		if (name == 'Main') {
			all_td[i].height = MainHeight-2;
		}
    }
}

//�E�C���h�E�T�C�Y�擾
function GetWindowSize(type){
    var ua = navigator.userAgent;       										// ���[�U�[�G�[�W�F���g
    var nWidth, nHeight;                  										// �T�C�Y
    var nHit = ua.indexOf("MSIE");     											// ���v���������̐擪�����̓Y����
    var bIE = (nHit >=  0);                										// IE ���ǂ���
    var bVer6 = (bIE && ua.substr(nHit+5, 1) == "6");  							// �o�[�W������ 6 ���ǂ���
    var bStd = (document.compatMode && document.compatMode=="CSS1Compat");		// �W�����[�h���ǂ���

	switch(type){
		case "width":
			if(bIE){
				if (bVer6 && bStd) {
					return document.documentElement.clientWidth;
				} else {
					return document.body.clientWidth;
				}
			}else if(document.layers){
				return(innerWidth);
			}else{
				return(-1);
			}
		break;
		case "height":
			if(bIE){
				if (bVer6 && bStd) {
					return document.documentElement.clientHeight;
				} else {
					return document.body.clientHeight;
				}
				return(document.body.clientHeight);
			}else if(document.layers){
				return(innerHeight);
			}else{
				return(-1);
			}
		break;
		default:
			return(-1);
		break;
	}
}

// �E�B���h�E�T�C�Y���ύX�ɂȂ����Ƃ��͑S�ẴI�u�W�F�N�g���ړ�����
function fnMoveObject() {

    // �E�B���h�E�̕��ύX�䗦���擾
	var moveX = GetWindowSize("width") - scrX;
	var BlankX = ( GetWindowSize("width") - 878 ) / 2
	
	for ( var i = 0; i < all_elms.length; i++) {
		if (all_elms[i].style.left != "" ) {

			var elm_class = getAttrValue ( all_elms[i], 'class' );

			if (elm_class == 'drop_target') {
				var tid = getAttrValue ( all_elms[i], 'tid' );
				
				if (tid == 'LeftNavi') {
					LeftMargin = marginLeftNavi;
				}else if (tid == 'RightNavi') {
					LeftMargin = marginRightNavi;
				}else if (tid == 'MainHead' || tid == 'MainFoot') {
					LeftMargin = marginMain;
				}else{
					LeftMargin = marginUnused;
				}

				if (BlankX > 0) {
					all_elms[i].style.left = BlankX + LeftMargin + 'px';
				}else{
					all_elms[i].style.left = LeftMargin + 'px';
				}
			}
		}
	}
	
	scrX = GetWindowSize("width");
	scrY = GetWindowSize("height");
	
	fnSortObj();
}
// ��ʂ̃��[�h�C�x���g�Ɋ֘A�t��
addEvent ( window, 'load', init, false );
