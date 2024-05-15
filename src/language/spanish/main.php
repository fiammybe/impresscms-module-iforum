<?php
	//* Spanish Translation by JulioNC  *//
	//Actualización y revisión para iForum por debianus
	 
	if (defined('MAIN_DEFINED')) return;
	define('MAIN_DEFINED', true);
	 
	define('_MD_ERROR', 'Error');
	define('_MD_NOPOSTS', 'Sin envíos');
	define('_MD_GO', 'Ir');
	define('_MD_SELFORUM', 'Seleccione un foro');
	 
	define('_MD_THIS_FILE_WAS_ATTACHED_TO_THIS_POST', 'Archivo');
	define('_MD_ALLOWED_EXTENSIONS', 'Extensiones permitidas:');
	define('_MD_MAX_FILESIZE', 'Tamaño máximo del archivo');
	define('_MD_ATTACHMENT', 'Archivo adjunto');
	define('_MD_FILESIZE', 'Tamaño');
	define('_MD_HITS', 'Clics');
	define('_MD_GROUPS', 'Grupos:');
	define('_MD_DEL_ONE', 'Eliminar sólo este mensaje');
	define('_MD_DEL_RELATED', 'Eliminar este mensaje y todos los relacionados');
	define('_MD_MARK_ALL_FORUMS', 'Marcar todos los foros');
	define('_MD_MARK_ALL_TOPICS', 'Marcar todos los temas');
	define('_MD_MARK_UNREAD', 'no leídos');
	define('_MD_MARK_READ', 'leidos');
	define('_MD_ALL_FORUM_MARKED', 'Todos los foros marcados');
	define('_MD_ALL_TOPIC_MARKED', 'Todos los temas marcados');
	define('_MD_BOARD_DISCLAIMER', 'Advertencia');
	 
	 
	//index.php
	define('_MD_ADMINCP', 'Administración');
	define('_MD_FORUM', 'Foro');
	define('_MD_WELCOME', 'Bienvenido al foro %s.');
	define('_MD_TOPICS', 'Temas');
	define('_MD_POSTS', 'Mensajes');
	define('_MD_LASTPOST', 'Último mensaje');
	define('_MD_MODERATOR', 'Moderador');
	define('_MD_NEWPOSTS', 'Con nuevos mensajes');
	define('_MD_NONEWPOSTS', 'Sin nuevos mensajes ');
	define('_MD_PRIVATEFORUM', 'Foro privado');
	define('_MD_BY', 'Por'); // Posted by
	define('_MD_TOSTART', 'Para comenzar a ver los mensajes seleccione el foro que quiera visitar.');
	define('_MD_TOTALTOPICSC', 'Total de temas: ');
	define('_MD_TOTALPOSTSC', 'Total de mensajes: ');
	define('_MD_TOTALUSER', 'Total de usuarios: ');
	define('_MD_TIMENOW', 'Hora actual: %s');
	define('_MD_LASTVISIT', 'Su última visita: %s');
	define('_MD_ADVSEARCH', 'Búsqueda avanzada');
	define('_MD_POSTEDON', 'Enviado el: ');
	define('_MD_SUBJECT', 'Tema');
	define('_MD_INACTIVEFORUM_NEWPOSTS', 'Foro inactivo con nuevos mensajes');
	define('_MD_INACTIVEFORUM_NONEWPOSTS', 'Foro inactivo sin nuevos mensajes');
	define('_MD_SUBFORUMS', 'Subforo');
	define('_MD_MAINFORUMOPT', 'Opciones');
	define("_MD_PENDING_POSTS_FOR_AUTH", "Mensajes pendientes de aprobación:");
	 
	 
	 
	//page_header.php
	define('_MD_MODERATEDBY', 'Moderado por');
	define('_MD_SEARCH', 'Buscar');
	//define('_MD_SEARCHRESULTS','Resultado de la búsqueda');
	define('_MD_FORUMINDEX', '%s índice del foro');
	define('_MD_POSTNEW', 'Enviar mensaje nuevo');
	define('_MD_REGTOPOST', 'Registrarse para enviar');
	 
	//search.php
	define('_MD_SEARCHALLFORUMS', 'Buscar en todos los foros');
	define('_MD_FORUMC', 'Foro');
	define('_MD_AUTHORC', 'Autor:');
	define('_MD_SORTBY', 'Ordenar por');
	define('_MD_DATE', 'Fecha');
	define('_MD_TOPIC', 'Tema');
	define('_MD_POST2', 'Post');
	define('_MD_USERNAME', 'Usuario');
	define('_MD_BODY', 'Cuerpo');
	define('_MD_SINCE', 'Desde');
	 
	//viewforum.php
	define('_MD_REPLIES', 'Respuestas');
	define('_MD_POSTER', 'Enviado por');
	define('_MD_VIEWS', 'Visitas');
	define('_MD_MORETHAN', 'Con nuevos mensajes - Popular');
	define('_MD_MORETHAN2', 'Sin nuevos mensajes - Popular');
	define('_MD_TOPICSHASATT', 'Tema con archivo adjunto');
	define('_MD_TOPICHASPOLL', 'Tema con encuesta.');
	define('_MD_TOPICLOCKED', 'Tema bloqueado.');
	define('_MD_LEGEND', 'Leyenda');
	define('_MD_NEXTPAGE', 'Página siguiente');
	define('_MD_SORTEDBY', 'Ordenar por');
	define('_MD_TOPICTITLE', 'Título del tema');
	define('_MD_NUMBERREPLIES', 'Número de respuestas');
	define('_MD_TOPICPOSTER', 'Enviado por');
	define('_MD_TOPICTIME', 'Fecha de publicación');
	define('_MD_LASTPOSTTIME', 'Hora del último envío');
	define('_MD_ASCENDING', 'Orden ascendente');
	define('_MD_DESCENDING', 'Orden descendente');
	define('_MD_FROMLASTHOURS', 'Desde las %s últimas horas');
	define('_MD_FROMLASTDAYS', 'Desde los %s últimos días');
	define('_MD_THELASTYEAR', 'Desde el año pasado');
	define('_MD_BEGINNING', 'Desde el principio');
	define('_MD_SEARCHTHISFORUM', 'Buscar en este foro');
	define('_MD_TOPIC_SUBJECTC', 'Prefijo del asunto:');
	 
	 
	define('_MD_RATINGS', 'Valoraciones');
	define("_MD_CAN_ACCESS", "Usted <strong>puede</strong> tener acceso al foro.<br />");
	define("_MD_CANNOT_ACCESS", "Usted <strong>no puede</strong> tener acceso al foro.<br />");
	define("_MD_CAN_POST", "<b>Puede</b> enviar mensajes.<br />");
	define("_MD_CANNOT_POST", "<b>No puede</b> enviar mensajes.<br />");
	define("_MD_CAN_VIEW", "<b>Puede</b> ver mensajes.<br />");
	define("_MD_CANNOT_VIEW", "<b>No puede</b> ver mensajes.<br />");
	define("_MD_CAN_REPLY", "<b>Puede</b> responder mensajes.<br />");
	define("_MD_CANNOT_REPLY", "<b>No puede</b> responder mensajes.<br />");
	define("_MD_CAN_EDIT", "<b>Puede</b> editar mensajes.<br />");
	define("_MD_CANNOT_EDIT", "<b>No puede</b> editar mensajes.<br />");
	define("_MD_CAN_DELETE", "<b>Puede</b> eliminar mensajes.<br />");
	define("_MD_CANNOT_DELETE", "<b>No puede</b> eliminar mensajes.<br />");
	define("_MD_CAN_ADDPOLL", "<b>Puede</b> crear encuestas.<br />");
	define("_MD_CANNOT_ADDPOLL", "<b>No puede</b> crear encuestas.<br />");
	define("_MD_CAN_VOTE", "<b>Puede</b> votar.<br />");
	define("_MD_CANNOT_VOTE", "<b>No puede</b> votar.<br />");
	define("_MD_CAN_ATTACH", "<b>Puede</b> adjuntar archivos.<br />");
	define("_MD_CANNOT_ATTACH", "<b>No puede</b> adjuntar archivos.<br />");
	define("_MD_CAN_NOAPPROVE", "<b>Puede</b> hacer un envío sin aprobación.<br />");
	define("_MD_CANNOT_NOAPPROVE", "<b>No puede</b> hacer un envío sin aprobación.<br />");
	define("_MD_IMTOPICS", "Temas importantes");
	define("_MD_NOTIMTOPICS", "Temas del foro");
	define('_MD_FORUMOPTION', 'Opciones del foro');
	 
	define('_MD_VAUP', 'Ver todos los mensajes sin contestar');
	define('_MD_VANP', 'Ver todos los mensajes nuevos');
	 
	 
	define('_MD_UNREPLIED', 'temas sin contestar');
	define('_MD_UNREAD', 'temas no leidos');
	define('_MD_ALL', 'todos los temas');
	define('_MD_ALLPOSTS', 'todos los mensajes');
	define('_MD_VIEW', 'Ver');
	 
	//viewtopic.php
	define('_MD_AUTHOR', 'Autor');
	define('_MD_LOCKTOPIC', 'Bloquear este tema');
	define('_MD_UNLOCKTOPIC', 'Desbloquear este tema');
	define('_MD_UNSTICKYTOPIC', 'Despegar este tema');
	define('_MD_STICKYTOPIC', 'Pegar este tema');
	define('_MD_DIGESTTOPIC', 'Incluir este tema en la selección');
	define('_MD_UNDIGESTTOPIC', 'Excluir este tema de la selección');
	define('_MD_MERGETOPIC', 'Combinar este tema');
	define('_MD_MOVETOPIC', 'Mover este tema');
	define('_MD_DELETETOPIC', 'Eliminar este tema');
	define('_MD_TOP', 'Arriba');
	define('_MD_BOTTOM', 'Abajo');
	define('_MD_PREVTOPIC', 'Tema anterior');
	define('_MD_NEXTTOPIC', 'Tema siguiente');
	define('_MD_GROUP', 'Grupo:');
	define('_MD_QUICKREPLY', 'respuesta rápida');
	define('_MD_POSTREPLY', 'Envíe su respuesta');
	define('_MD_PRINTTOPICS', 'Imprimir este tema');
	define('_MD_PRINT', 'Imprimir este mensaje');
	define('_MD_REPORT', 'Reporte');
	define('_MD_PM', 'Mensaje privado');
	define('_MD_EMAIL', 'Email');
	define('_MD_WWW', 'WWW');
	define('_MD_AIM', 'AIM');
	define('_MD_YIM', 'YIM');
	define('_MD_MSNM', 'MSNM');
	define('_MD_ICQ', 'ICQ');
	define('_MD_PRINT_TOPIC_LINK', 'URL de esta discusión');
	define('_MD_ADDTOLIST', 'Agregar a su lista de contactos');
	define('_MD_TOPICOPT', 'Opciones del tema');
	define('_MD_VIEWMODE', 'Modo');
	define('_MD_NEWEST', 'Nuevos primeros');
	define('_MD_OLDEST', 'Viejos primero');
	 
	define('_MD_FORUMSEARCH', 'Buscar');
	 
	define('_MD_RATED', 'Valorado:');
	define('_MD_RATE', 'Valorar');
	define('_MD_RATEDESC', 'Valorar este hilo');
	define('_MD_RATING', 'Votar');
	define('_MD_RATE1', 'Horrible');
	define('_MD_RATE2', 'Malo');
	define('_MD_RATE3', 'Normal');
	define('_MD_RATE4', 'Bueno');
	define('_MD_RATE5', 'Excelente');
	 
	define('_MD_TOPICOPTION', 'Opciones');
	define('_MD_KARMA_REQUIREMENT', 'Su karma personal %s no es el karma requerido %s. <br /> Por favor inténtelo más adelante.');
	define('_MD_REPLY_REQUIREMENT', 'Para ver este mensaje, necesita contestar.');
	define('_MD_TOPICOPTIONADMIN', 'Opciones del tema');
	define('_MD_POLLOPTIONADMIN', 'Opciones de encuesta');
	 
	define('_MD_EDITPOLL', 'Modificar esta encuesta');
	define('_MD_DELETEPOLL', 'Eliminar esta encuesta');
	define('_MD_RESTARTPOLL', 'Restablecer esta encuesta');
	define('_MD_ADDPOLL', 'Agregar encuesta');
	 
	define('_MD_QUICKREPLY_EMPTY', 'Inserte su respuesta rápida aquí');
	 
	define('_MD_LEVEL', 'Nivel :');
	define('_MD_HP', 'HP :');
	define('_MD_MP', 'MP :');
	define('_MD_EXP', 'EXP :');
	 
	define('_MD_BROWSING', 'Usuarios revisando este tema:');
	define('_MD_POSTTONEWS', 'Publicar este mensaje en las noticias');
	 
	define('_MD_EXCEEDTHREADVIEW', 'La cantidad de mensajes en este tema exceden el máximo permitido para el modo de vista en árbol<br />Por favor cámbielo a modo de vista plana');
	 
	 
	//forumform.inc
	define('_MD_PRIVATE', 'Este es un foro <b>privado</b>.<br />Sólo los usuarios autorizados pueden enviar y responder mensajes en este foro.');
	define('_MD_QUOTE', 'Citar');
	define('_MD_VIEW_REQUIRE', 'Requisitos para ser visto:');
	define('_MD_REQUIRE_KARMA', 'Karma ');
	define('_MD_REQUIRE_REPLY', 'Responder ');
	define('_MD_REQUIRE_NULL', 'Sin requisitos');
	 
	define("_MD_SELECT_FORMTYPE", "Seleccione el tipo de editor");
	 
	define("_MD_FORM_COMPACT", "Compacto");
	define("_MD_FORM_DHTML", "DHTML");
	define("_MD_FORM_SPAW", "Editor Spaw");
	define("_MD_FORM_HTMLAREA", "HTMLArea");
	define("_MD_FORM_FCK", "Editor FCK");
	define("_MD_FORM_KOIVI", "Editor Koivi");
	define("_MD_FORM_TINYMCE", "Editor TinyMCE");
	 
	// ERROR messages
	define('_MD_ERRORFORUM', 'Gracias por su envío.');
	define('_MD_ERRORPOST', 'ERROR: Mensaje no seleccionado.');
	define('_MD_NORIGHTTOVIEW', 'No tiene permiso para ver este tema.');
	define('_MD_NORIGHTTOPOST', 'No tiene permiso para enviar en este foro.');
	define('_MD_NORIGHTTOEDIT', 'No tiene permiso para modificar los contenidos de este foro.');
	define('_MD_NORIGHTTOREPLY', 'No tiene permiso para responder en este foro.');
	define('_MD_NORIGHTTOACCESS', 'No tiene permiso para acceder a este foro.');
	define('_MD_ERRORTOPIC', 'ERROR: tema no seleccionado.');
	define('_MD_ERRORCONNECT', 'ERROR: Imposible conectar con la base de datos del foro.');
	define('_MD_ERROREXIST', 'ERROR: El foro seleccionado no existe. Por favor regrese atrás e inténtelo de nuevo.');
	define('_MD_ERROROCCURED', 'Ha ocurrido un error.');
	define('_MD_COULDNOTQUERY', 'Imposible consultar la base de datos.');
	define('_MD_FORUMNOEXIST', 'ERROR: El foro/tema seleccionado no existe. Por favor regrese atrás e inténtelo de nuevo.');
	define('_MD_USERNOEXIST', 'ERROR: El usuario no existe.  Por favor regrese atrás e inténtelo de nuevo.');
	define('_MD_COULDNOTREMOVE', 'ERROR: No es posible eliminar el mensaje de la base de datos.');
	define('_MD_COULDNOTREMOVETXT', 'ERROR: No es posible eliminar el texto del mensaje.');
	define('_MD_TIMEISUP', 'Ha sobrepasado el tiempo límite para poder editar este mensaje.');
	define('_MD_TIMEISUPDEL', 'Ha sobrepasado el tiempo límite para poder eliminar este mensaje.');
	 
	//reply.php
	define('_MD_ON', 'enviado el'); //Posted on
	define('_MD_USERWROTE', '%s escribió:'); // %s is username
	define('_MD_RE', 'Re');
	 
	//post.php
	define('_MD_EDITNOTALLOWED', 'No está autorizado para modficar este mensaje.');
	define('_MD_EDITEDBY', 'Modificado por');
	define('_MD_ANONNOTALLOWED', 'Los invitados no están autorizados para enviar mensajes.<br>Por favor regístrese.');
	define('_MD_THANKSSUBMIT', 'Gracias por el envío.');
	define('_MD_REPLYPOSTED', 'Una respuesta a su mensaje ha sido enviada.');
	define('_MD_HELLO', 'Hola %s,');
	define('_MD_URRECEIVING', 'Esta recibiendo este correo debido a que un mensaje que envió en %s ha sido contestado.'); // %s is your site name
	define('_MD_CLICKBELOW', 'Haga clic en el enlace de abajo para ver el hilo:');
	define('_MD_WAITFORAPPROVAL', 'Gracias. Por favor espere la aprobación del mensaje.');
	define('_MD_POSTING_LIMITED', 'Le recomiendo tomar un descanso y volver en %d segundos');
	 
	//forumform.inc
	define('_MD_NAMEMAIL', 'Nombre/Email:');
	define('_MD_LOGOUT', 'Salir');
	define('_MD_REGISTER', 'Registrarse');
	define('_MD_SUBJECTC', 'Asunto:');
	define('_MD_MESSAGEICON', 'Icono del mensaje:');
	define('_MD_MESSAGEC', 'Mensaje:');
	define('_MD_ALLOWEDHTML', 'Permitir HTML:');
	define('_MD_OPTIONS', 'Opciones:');
	define('_MD_POSTANONLY', 'Envío anónimo');
	define('_MD_DOSMILEY', 'Permitir caritas');
	define('_MD_DOXCODE', 'Permitir código de ImpressCMS');
	define('_MD_DOBR', 'Permitir saltos de línea (es conveniente no activarlo si la opción de permitir HTML está activada)');
	define('_MD_DOHTML', 'Permitir etiquetas HTML');
	define('_MD_NEWPOSTNOTIFY', 'Notificarme de nuevos envíos en este tema');
	define('_MD_ATTACHSIG', 'Incluir firma');
	define('_MD_POST', 'Envío');
	define('_MD_SUBMIT', 'Enviar');
	define('_MD_CANCELPOST', 'Cancelar envío');
	define('_MD_REMOVE', 'Eliminar');
	define('_MD_UPLOAD', 'Subir');
	 
	// forumuserpost.php
	define('_MD_ADD', 'Agregar');
	define('_MD_REPLY', 'Responder');
	define('_MD_EXTRAS', 'extras');
	 
	// topicmanager.php
	define('_MD_VIEWTHETOPIC', 'Ver el tema');
	define('_MD_RETURNTOTHEFORUM', 'Regresar al foro');
	define('_MD_RETURNFORUMINDEX', 'Regresar al índice del foro');
	define('_MD_ERROR_BACK', 'ERROR: Por favor regrese e inténtelo de nuevo.');
	define('_MD_GOTONEWFORUM', 'Ver el tema actualizado');
	 
	define('_MD_TOPICDELETE', 'El tema ha sido eliminado.');
	define('_MD_TOPICMERGE', 'Se ha combinado el tema.');
	define('_MD_TOPICMOVE', 'El tema ha sido movido.');
	define('_MD_TOPICLOCK', 'El tema ha sido bloqueado.');
	define('_MD_TOPICUNLOCK', 'El tema ha sido desbloqueado.');
	define('_MD_TOPICSTICKY', 'El tema ha sido pegado.');
	define('_MD_TOPICUNSTICKY', 'El tema ha sido despegado.');
	define('_MD_TOPICDIGEST', 'El tema ha sido incluido en la selección.');
	define('_MD_TOPICUNDIGEST', 'El tema ha sido excluido de la selección.');
	 
	define('_MD_DELETE', 'Eliminar');
	define('_MD_MOVE', 'Mover');
	define('_MD_MERGE', 'Combinar');//Fusión - Merge
	define('_MD_LOCK', 'Bloquear');
	define('_MD_UNLOCK', 'Desbloquear');
	define('_MD_STICKY', 'Pegar');
	define('_MD_UNSTICKY', 'Despegar');
	define('_MD_DIGEST', 'Incluir en la selección');
	define('_MD_UNDIGEST', 'Excluir de la selección');
	 
	define('_MD_DESC_DELETE', 'Al presionar el botón de Eliminar al final de este formulario el tema selecionado y todos sus mensajes relacionados serán  <b>permanentemente</b> eliminados.');
	define('_MD_DESC_MOVE', 'Al presionar el botón de Mover al final de este formulario el tema selecionado y todos sus mensajes relacionados serán movidos al foro seleccionado.');
	define('_MD_DESC_MERGE', 'Al presionar el botón de Combinar al final de este formulario el tema selecionado y todos sus mensajes relacionados, serán combinados al tema que usted tiene identificado para ser seleccionado.');//Once you press the merge button at the bottom of this form the topic you have selected, and its related posts, will be merged to the topic you have selected.<br /><strong>The destination topic ID must be smaller than current one</strong>.
	define('_MD_DESC_LOCK', 'Al presionar el botón de Bloquear al final de este formulario el tema selecionado será bloqueado. Puede desbloquearlo cuando quiera si así lo desea.');
	define('_MD_DESC_UNLOCK', 'Al presionar el botón de Desbloquear al final de este formulario el tema selecionado será desbloqueado. Puede bloquearlo cuando quiera si así lo desea.');
	define('_MD_DESC_STICKY', 'Al presionar el botón de Pegar al final de este formulario el tema selecionado será pegado. Puede despegarlo cuando quiera si así lo desea.');
	define('_MD_DESC_UNSTICKY', 'Al presionar el botón de Despegar al final de este formulario el tema selecionado será despagado. Puede pegarlo cuando quiera si así lo desea.');
	define('_MD_DESC_DIGEST', 'Al presionar el botón de Incluir en la selección al final de este formulario el tema selecionado será incluido en la selección o compendio de temas. Puede excluirlo cuando quiera si así lo desea.');
	define('_MD_DESC_UNDIGEST', 'Al presionar el botón de Excluir de la selección al final de este formulario el tema selecionado será excluido de la selección o compendio de temas. Puede incluirlo cuando quiera si así lo desea.');
	 
	define('_MD_MERGETOPICTO', 'Tema de la combinación:');//Merge Topic To:
	define('_MD_MOVETOPICTO', 'Mover tema a:');
	define('_MD_NOFORUMINDB', 'Sin foros en la base de datos.');
	 
	// delete.php
	define('_MD_DELNOTALLOWED', 'Lo lamento, pero no está autorizado para eliminar este mensaje.');
	define('_MD_AREUSUREDEL', '¿está seguro de querer eliminar este mensaje y todos sus relacionados?');
	define('_MD_POSTSDELETED', 'El mensaje seleccionado y todos sus mensajes relacionados han sido eliminados.');
	define('_MD_POSTDELETED', 'El mensaje seleccionado ha sido eliminado.');
	 
	// definitions moved from global.
	define('_MD_THREAD', 'Hilo');
	define('_MD_FROM', 'Desde:');
	define('_MD_JOINED', 'Registrado');
	define('_MD_ONLINE', 'En línea');
	define('_MD_OFFLINE', 'Ausente');
	define('_MD_FLAT', 'Plana');
	 
	 
	// online.php
	define('_MD_USERS_ONLINE', 'Usuarios en línea:');
	define('_MD_ANONYMOUS_USERS', 'Invitados:');
	define('_MD_REGISTERED_USERS', 'Registrados: ');
	define('_MD_BROWSING_FORUM', 'Usuarios navegando los foros');
	define('_MD_TOTAL_ONLINE', 'En total hay %d usuarios en línea.');
	define('_MD_ADMINISTRATOR', 'Administrador');
	 
	define('_MD_NO_SUCH_FILE', 'El archivo no existe.');
	define('_MD_ERROR_UPATEATTACHMENT', 'Un error se ha producido al enviar el archivo adjunto.');
	 
	// ratethread.php
	define("_MD_CANTVOTEOWN", "No puede votar por un envío realizado por usted mismo.<br />Todos los votos son guardados y revisados.");
	define("_MD_VOTEONCE", "Por favor no vote más de una vez por el mismo tema.");
	define("_MD_VOTEAPPRE", "Su voto es apreciado.");
	define("_MD_THANKYOU", "Gracias por tomarse el tiempo necesario para votar en %s"); // %s is your site name
	define("_MD_VOTES", "Votos");
	define("_MD_NOVOTERATE", "Todavía no ha valorado este tema.");
	 
	 
	// polls.php
	define("_MD_POLL_DBUPDATED", "Base de datos actualizada satisfactoriamente.");
	define("_MD_POLL_POLLCONF", "Configuracion de encuestas");
	define("_MD_POLL_POLLSLIST", "Lista de encuestas");
	define("_MD_POLL_AUTHOR", "Autor de la encuesta");
	define("_MD_POLL_DISPLAYBLOCK", "¿Mostar en el bloque?");
	define("_MD_POLL_POLLQUESTION", "Pregunta de la encuesta");
	define("_MD_POLL_VOTERS", "Total votantes");
	define("_MD_POLL_VOTES", "Total votos");
	define("_MD_POLL_EXPIRATION", "Finalización");
	define("_MD_POLL_EXPIRED", "Finalizada");
	define("_MD_POLL_VIEWLOG", "Ver bitácora");
	define("_MD_POLL_CREATNEWPOLL", "Crear nueva encuesta");
	define("_MD_POLL_POLLDESC", "Descripción de la encuesta");
	define("_MD_POLL_DISPLAYORDER", "Orden de visionado");
	define("_MD_POLL_ALLOWMULTI", "¿Permitir selecciones múltiples?");
	define("_MD_POLL_NOTIFY", "¿Notificar al autor cuando finalice?");
	define("_MD_POLL_POLLOPTIONS", "Opciones");
	define("_MD_POLL_EDITPOLL", "Modificar encuesta");
	define("_MD_POLL_FORMAT", "Formato de fecha: dd-mm-aaaa hh:mm:ss");
	define("_MD_POLL_CURRENTTIME", "La hora actual es %s");
	define("_MD_POLL_EXPIREDAT", "Finalizó el %s");
	define("_MD_POLL_RESTART", "Restablecer esta encuesta");
	define("_MD_POLL_ADDMORE", "Agregar más opciones");
	define("_MD_POLL_RUSUREDEL", "¿Está seguro de querer eliminar esta encuesta y todos sus comentarios?");
	define("_MD_POLL_RESTARTPOLL", "Restablecer encuesta");
	define("_MD_POLL_RESET", "¿Poner a cero todos los registros de esta encuesta?");
	define("_MD_POLL_ADDPOLL", "Agregar encuesta");
	define("_MD_POLLMODULE_ERROR", "El módulo de encuestas no está disponible");
	 
	//report.php
	define("_MD_REPORTED", "Gracias por su ayuda. Su reporte ha sido enviado a los administradores del sitio.");
	define("_MD_REPORT_EORROR", "Un error ha ocurrido al intentar enviar el reporte.");
	define("_MD_REPORT_TEXT", "Mensaje del reporte:");
	 
	define("_MD_PDF", "Crear PDF con este mensaje");
	define("_MD_PDF_PAGE", "Página %s");
	 
	//print.php
	define("_MD_COMEFROM", "Este mensaje viene de :");
	 
	//viewpost.php
	define("_MD_VIEWALLPOSTS", "Todos los mensajes");
	define("_MD_VIEWTOPIC", "Tema");
	define("_MD_VIEWFORUM", "Foro");
	 
	define("_MD_COMPACT", "Compacto");
	 
	define("_MD_WELCOME_SUBJECT", "%s ha entrado en el foro");
	define("_MD_WELCOME_MESSAGE", "Hola, %s es un recién llegado.");
	 
	define("_MD_VIEWNEWPOSTS", "Ver nuevos mensajes");
	 
	define("_MD_INVALID_SUBMIT", "Envío inválido. Puede que su sesión expirase. Por favor reenvíelo o haga una copia del texto del mensaje e ingrese nuevamente para volver a enviarlo si fuese necesario.");
	 
	define("_MD_ACCOUNT", "Perfil");
	define("_MD_NAME", "Nombre");
	define("_MD_PASSWORD", "Contraseña");
	define("_MD_LOGIN", "Ingreso");
	 
	define("_MD_TRANSFER", "Transferir a");//Transferencia
	define("_MD_TRANSFER_DESC", "Transferir el mensaje a otras aplicaciones");
	define("_MD_TRANSFER_DONE", "La acción ha sido ejecutada: %s");
	 
	define("_MD_APPROVE", "Aprobar");
	define("_MD_RESTORE", "Restaurar");
	define("_MD_SPLIT_ONE", "Split");// Split ???
	define("_MD_SPLIT_TREE", "Dividir Hijos");
	define("_MD_SPLIT_ALL", "Dividir Todos");
	 
	define("_MD_TYPE_ADMIN", "Admin");
	define("_MD_TYPE_VIEW", "Ver");
	define("_MD_TYPE_PENDING", "Pendiente");
	define("_MD_TYPE_DELETED", "Borrar");
	define("_MD_TYPE_SUSPEND", "Suspensión");
	 
	define("_MD_DBUPDATED", "Base de datos actualizada con éxito");
	 
	define("_MD_SUSPEND_SUBJECT", "El usuario %s ha sido suspendido por %d días");
	define("_MD_SUSPEND_TEXT", "El usuario %s ha sido suspendido por %d días: <br />[quote]%s[/quote]<br /> <br /> La suspensión es válida hasta %s");//User %s is suspended for %d days due to:<br />[quote]%s[/quote]<br /><br />The suspension is valid till %s
	define("_MD_SUSPEND_UID", "ID de Usuario");
	define("_MD_SUSPEND_IP", "IP (Todos los segmentos)");
	define("_MD_SUSPEND_DURATION", "Duración de la suspensión(días)");
	define("_MD_SUSPEND_DESC", "Razón de la suspensión");
	define("_MD_SUSPEND_LIST", "Lista de suspendidos");
	define("_MD_SUSPEND_START", "Inicio");
	define("_MD_SUSPEND_EXPIRE", "Fin");
	define("_MD_SUSPEND_SCOPE", "Alcance");//Scope
	define("_MD_SUSPEND_MANAGEMENT", "Administrar Moderación");
	define("_MD_SUSPEND_NOACCESS", "Se ha suspendido su identificación o IP");
	 
	// !!IMPORTANT!! insert '\' to any char among reserved chars: "a", "A","B","c","d","D","F","g","G","h","H","i","I","j","l","L","m","M","n","O","r","s","S","t","T","U","w","W","Y","y","z","Z"
	// insert additional '\' to 't', 'r', 'n'
	define("_MD_TODAY", "\H\o\y G:i:s");
	define("_MD_YESTERDAY", "\A\y\e\\r G:i:s");
	define("_MD_MONTHDAY", "j/n G:i:s");
	define("_MD_YEARMONTHDAY", "j/n/Y G:i");
	 
	// For user info
	// If you have customized userbar, define here.
	/*require_once(ICMS_ROOT_PATH."/modules/".basename(  dirname(  dirname(  dirname( __FILE__ ) ) ) )."/class/user.php");
	class User_language extends User
	{
	function User_language(&$user)
	{
	$this->User($user);
	}
	 
	function &getUserbar()
	{
	global $isadmin;
	if (empty(icms::$module->config['userbar_enabled'])) return null;
	$user =& $this->user;
	$userbar = array();
	$userbar[] = array("link"=>ICMS_URL . "/userinfo.php?uid=" . $user->getVar("uid"), "name" =>_PROFILE);
	if (is_object(icms::$user))
	$userbar[]= array("link"=>"javascript:void openWithSelfMain('" . ICMS_URL . "/pmlite.php?send2=1&amp;to_userid=" . $user->getVar("uid") . "', 'pmlite', 450, 380);", "name"=>_MD_PM);
	if ($user->getVar('user_viewemail') || $isadmin)
	$userbar[]= array("link"=>"javascript:void window.open('mailto:" . $user->getVar('email') . "', 'new');", "name"=>_MD_EMAIL);
	if ($user->getVar('url'))
	$userbar[]= array("link"=>"javascript:void window.open('" . $user->getVar('url') . "', 'new');", "name"=>_MD_WWW);
	if ($user->getVar('user_icq'))
	$userbar[]= array("link"=>"javascript:void window.open('http://wwp.icq.com/scripts/search.dll?to=" . $user->getVar('user_icq')."', 'new');", "name" => _MD_ICQ);
	if ($user->getVar('user_aim'))
	$userbar[]= array("link"=>"javascript:void window.open('aim:goim?screenname=" . $user->getVar('user_aim') . "&amp;message=Hi+" . $user->getVar('user_aim') . "+Are+you+there?" . "', 'new');", "name"=>_MD_AIM);
	if ($user->getVar('user_yim'))
	$userbar[]= array("link"=>"javascript:void window.open('http://edit.yahoo.com/config/send_webmesg?.target=" . $user->getVar('user_yim') . "&amp;.src=pg" . "', 'new');", "name"=> _MD_YIM);
	if ($user->getVar('user_msnm'))
	$userbar[]= array("link"=>"javascript:void window.open('http://members.msn.com?mem=" . $user->getVar('user_msnm') . "', 'new');", "name" => _MD_MSNM);
	return $userbar;
	}
	}*/
	define('_PDF_SUBJECT', 'Asunto');
	define('_PDF_TOPIC', 'Tema');
	define('_PDF_DATE', 'Fecha');
	define('_MD_UP', 'Arriba');
	define('_MD_POSTTIME', 'Fecha');
	define('_MD_RIGHT', 'Derecho');
	define('_MD_LEFT', 'Izquierdo');

	//new since 1.00
	define('_MD_CHANGE_THE_FORUM', 'Change the forum');
?>