PGDMP     .    &                x         	   case_mind    12.2    12.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            	           1262    327986 	   case_mind    DATABASE     �   CREATE DATABASE case_mind WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE case_mind;
                postgres    false            �            1259    344316    usuario    TABLE       CREATE TABLE public.usuario (
    id_usuario integer NOT NULL,
    nome character varying(255) NOT NULL,
    cpf character(11) NOT NULL,
    email character varying(255) NOT NULL,
    senha character varying(255) NOT NULL,
    grau_acesso character(1) DEFAULT 'U'::bpchar NOT NULL
);
    DROP TABLE public.usuario;
       public         heap    postgres    false            �            1259    344314    usuario_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE public.usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.usuario_id_usuario_seq;
       public          postgres    false    203            
           0    0    usuario_id_usuario_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.usuario_id_usuario_seq OWNED BY public.usuario.id_usuario;
          public          postgres    false    202            �
           2604    344319    usuario id_usuario    DEFAULT     x   ALTER TABLE ONLY public.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuario_id_usuario_seq'::regclass);
 A   ALTER TABLE public.usuario ALTER COLUMN id_usuario DROP DEFAULT;
       public          postgres    false    202    203    203                      0    344316    usuario 
   TABLE DATA           S   COPY public.usuario (id_usuario, nome, cpf, email, senha, grau_acesso) FROM stdin;
    public          postgres    false    203   �                  0    0    usuario_id_usuario_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.usuario_id_usuario_seq', 11, true);
          public          postgres    false    202            �
           2606    344325    usuario usuario_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public            postgres    false    203               .  x�m�ɖ�8�u�*\�"�FE���&2h�A���اze�̛��|0���4)fz�Z�V��@�碊u�"��^�b��u-	-��.��8~�;�`g^�+T����6=����ɹ���J�i�#?e/��0��Z����KZ\Ҋ�]C�
�ca�(P y'��Toya�4�����C~�&g1;I6��4��̆�w���%Z�}�о���gK�t�j JXECY�;��l5��i`�����N�+���V�F��+�n�������z,x�]�v}DڙA���A�X���;��:$�-��ū�.ʞ��8��EȾ_�s}PO$69t5W�J��$�n��K(�$�X!� c����z-��W��0g�E�y�m�7#?�q&ʙ�c;���Hj}$Q���(�};s
�LhC k�"ͱ���S����LmӒhf0�8��N6�}uJ}��OH���Ԩ?�}�D7J��l߳EĂ  �T%��{�)��������J�/ז>vq�W�1�%�����"9��]y��<��4fߐ*�ی�4���ؼTƱF���`7LeWe}!�����=����t����aI�Ӗ=N	���&���`�
L�蓂V	��MD*��H�᧨%�eʻ0$8��OD��EN�3`�v�~zJ�{�^���r���0Q�`����몫YA@�
��P@��>1jH�֑���29>���'�ltI����Y?���<���w�e{�6����<Iq�R��%�0}b'�x��8�;�h�o�ۅ��4�(���y��A��h^�Y~�h�x0�o������w     