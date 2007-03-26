CREATE TABLE dtb_site_control (
    control_id serial primary key NOT NULL,
    control_title text NOT NULL DEFAULT '',
    control_text text NOT NULL DEFAULT '',
    control_flg int2 NOT NULL DEFAULT 2,
    del_flg int2 NOT NULL DEFAULT 0,
    memo text NOT NULL DEFAULT '',
    create_date timestamp NOT NULL DEFAULT now(),
    update_date timestamp NOT NULL DEFAULT now()
);

INSERT INTO dtb_site_control (control_title, control_text) VALUES('�ȥ�å��Хå���ǽ', '�ȥ�å��Хå���ǽ����Ѥ��뤫�ɤ�������ꤷ�ޤ���');
INSERT INTO dtb_site_control (control_title, control_text) VALUES('���ե��ꥨ���ȵ�ǽ', '���ե��ꥨ���ȵ�ǽ����Ѥ��뤫�ɤ�������ꤷ�ޤ���');
