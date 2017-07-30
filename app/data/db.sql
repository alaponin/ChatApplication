CREATE TABLE "conversation" ( `id` INTEGER NOT NULL, `title` TEXT, `creator_id` INTEGER, PRIMARY KEY(`id`), FOREIGN KEY(`creator_id`) REFERENCES 'user'('id') );
CREATE TABLE "message" ( `id` INTEGER NOT NULL, `sender_id` INTEGER NOT NULL, `conversation_id` INTEGER NOT NULL, `body` TEXT, PRIMARY KEY(`id`), FOREIGN KEY(`sender_id`) REFERENCES 'user'('id'), FOREIGN KEY(`conversation_id`) REFERENCES `conversation`(`id`) );
CREATE TABLE `participant` ( `id` INTEGER NOT NULL, `conversation_id` INTEGER, `user_id` INTEGER, PRIMARY KEY(`id`), FOREIGN KEY(`conversation_id`) REFERENCES 'conversation'('id') );
CREATE TABLE `user` ( `id` INTEGER NOT NULL, `name` TEXT NOT NULL, `email` TEXT NOT NULL, `password` TEXT, PRIMARY KEY(`id`) );

INSERT INTO user (name, email, password) VALUES ('Arne Laponin', 'arne.laponin@gmail.com', '12345');
INSERT INTO user (name, email, password) VALUES ('Jane Smith', 'jane.smith@gmail.com', '12345');
INSERT INTO user (name, email, password) VALUES ('John Smith', 'john.smith@gmail.com', '12345');

INSERT INTO conversation (title, creator_id) VALUES ('Jane Smith', 1);
INSERT INTO conversation (title, creator_id) VALUES ('John Smith', 1);
INSERT INTO conversation (title, creator_id) VALUES ('Party Planning Committee', 1);
INSERT INTO conversation (title, creator_id) VALUES ('John Smith', 2);
INSERT INTO conversation (title, creator_id) VALUES ('Jane Smith', 3);

INSERT INTO participant (conversation_id, user_id) VALUES (1, 1);
INSERT INTO participant (conversation_id, user_id) VALUES (1, 2);
INSERT INTO participant (conversation_id, user_id) VALUES (2, 1);
INSERT INTO participant (conversation_id, user_id) VALUES (2, 3);
INSERT INTO participant (conversation_id, user_id) VALUES (3, 1);
INSERT INTO participant (conversation_id, user_id) VALUES (3, 2);
INSERT INTO participant (conversation_id, user_id) VALUES (3, 3);
INSERT INTO participant (conversation_id, user_id) VALUES (4, 2);
INSERT INTO participant (conversation_id, user_id) VALUES (4, 3);
INSERT INTO participant (conversation_id, user_id) VALUES (5, 2);
INSERT INTO participant (conversation_id, user_id) VALUES (5, 3);

INSERT INTO message (sender_id, conversation_id, body) VALUES (1, 1, 'Hey, how are you?');
INSERT INTO message (sender_id, conversation_id, body) VALUES (2, 1, 'Hey, I am doing good.');
INSERT INTO message (sender_id, conversation_id, body) VALUES (1, 2, 'Hey, how are you?');
INSERT INTO message (sender_id, conversation_id, body) VALUES (3, 2, 'Hey, I am not doing so good.');
INSERT INTO message (sender_id, conversation_id, body) VALUES (1, 3, 'Hey, everybody lets organise a party!');
INSERT INTO message (sender_id, conversation_id, body) VALUES (3, 3, 'Sure!');
INSERT INTO message (sender_id, conversation_id, body) VALUES (2, 3, 'Good idea!');
INSERT INTO message (sender_id, conversation_id, body) VALUES (2, 4, 'Hey John, how are you doing?');
INSERT INTO message (sender_id, conversation_id, body) VALUES (3, 5, 'Hey Jane, how are you doing?');
INSERT INTO message (sender_id, conversation_id, body) VALUES (2, 5, 'Hey John, I am doing excellent.');