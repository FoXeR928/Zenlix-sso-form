<?php
    $query_config=array(
        'number_applications'=>5,
        'rejected_text'=>"Отклонено",
    );
    $query=array(
        'get_tickets'=>"SELECT id, subj, msg, date_create, ok_date, status FROM tickets WHERE user_init_id=%s ORDER BY id DESC LIMIT %s",
        'get_comments'=>"SELECT user_id, comment_text FROM comments WHERE t_id=%s",
        'find_reject'=>"SELECT comment_text FROM comments WHERE t_id=%s AND comment_text='%s<br>'",
        'get_fio'=>"SELECT fio FROM users WHERE id=%s",
        'get_user_id'=>"SELECT id FROM users WHERE login='%s'",
        'add_ticket'=>"INSERT INTO tickets SET user_init_id='%s', user_to_id='0', date_create='%s', subj='%s', msg='%s', client_id='%s', unit_id='%s', status='0', arch='0', is_read='0', lock_by='0', ok_by='0', prio='1', last_update='%s', sla_plan_id='0'",
        'ticket_id'=>"SELECT id FROM tickets WHERE client_id=%s ORDER BY id DESC LIMIT 1",
        'add_hash'=>"UPDATE tickets SET hash_name=%s WHERE id=%s",
        'add_ticket_info'=>"INSERT INTO ticket_info SET ticket_id='%s', ticket_source='web', ip='%s', os='Windows',browser='Yandex'",
        'add_ticket_log'=>"INSERT INTO ticket_log SET date_op='%s', msg='create', init_user_id='%s', to_user_id='380', ticket_id='%s', to_unit_id='1'",
        'get_active_tiket'=>"SELECT subj, msg, fio FROM tickets, users WHERE tickets.status=0 and users.id=tickets.client_id and tickets.unit_id=6 ORDER BY tickets.id DESC",
    );
?>