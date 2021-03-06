PGDMP             	             z         	   appvendas    14.1    14.1 /                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            !           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            "           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            #           1262    16394 	   appvendas    DATABASE     i   CREATE DATABASE appvendas WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE appvendas;
                postgres    false            $           0    0    DATABASE appvendas    COMMENT     K   COMMENT ON DATABASE appvendas IS 'Banco de Dados Sistema Pedido de Venda';
                   postgres    false    3363            ?            1259    16490 
   tab_pedido    TABLE     ?   CREATE TABLE public.tab_pedido (
    ped_id integer NOT NULL,
    ped_datacadastro date,
    ped_horacadastro text,
    ip_lancamento text,
    user_codigo integer,
    ped_cancelado text
);
    DROP TABLE public.tab_pedido;
       public         heap    postgres    false            ?            1259    16481    tab_pedido_item    TABLE       CREATE TABLE public.tab_pedido_item (
    peditem_id integer NOT NULL,
    pedido_id integer NOT NULL,
    produto_id integer NOT NULL,
    peditem_qtdevendida double precision,
    peditem_precounitario double precision,
    peditem_aliquotaicms double precision,
    peditem_aliquotaipi double precision,
    peditem_datacadastro date,
    peditem_horacadastro text,
    ip_lancamento text,
    user_codigo integer,
    peditem_precototal double precision,
    peditem_precoicms double precision,
    peditem_precoipi double precision
);
 #   DROP TABLE public.tab_pedido_item;
       public         heap    postgres    false            ?            1259    16480    tab_pedido_item_peditem_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.tab_pedido_item_peditem_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tab_pedido_item_peditem_id_seq;
       public          postgres    false    218            %           0    0    tab_pedido_item_peditem_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tab_pedido_item_peditem_id_seq OWNED BY public.tab_pedido_item.peditem_id;
          public          postgres    false    217            ?            1259    16489    tab_pedido_ped_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.tab_pedido_ped_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tab_pedido_ped_id_seq;
       public          postgres    false    220            &           0    0    tab_pedido_ped_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tab_pedido_ped_id_seq OWNED BY public.tab_pedido.ped_id;
          public          postgres    false    219            ?            1259    16472    tab_produtos    TABLE     !  CREATE TABLE public.tab_produtos (
    pro_id integer NOT NULL,
    pro_descricao text NOT NULL,
    pro_precovenda double precision,
    categoria_codigo integer,
    pro_ativo text,
    pro_datacadastro date,
    pro_horacadastro text,
    ip_lancamento text,
    user_codigo integer
);
     DROP TABLE public.tab_produtos;
       public         heap    postgres    false            ?            1259    16471    tab_produtos_pro_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.tab_produtos_pro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tab_produtos_pro_id_seq;
       public          postgres    false    216            '           0    0    tab_produtos_pro_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tab_produtos_pro_id_seq OWNED BY public.tab_produtos.pro_id;
          public          postgres    false    215            ?            1259    16463    tab_produtos_tipo    TABLE     0  CREATE TABLE public.tab_produtos_tipo (
    cat_id integer NOT NULL,
    cat_descricao text NOT NULL,
    cat_aliquotaicms double precision,
    cat_aliquotaipi double precision,
    cat_ativo text,
    cat_datacadastro date,
    cat_horacadastro text,
    ip_lancamento text,
    user_codigo integer
);
 %   DROP TABLE public.tab_produtos_tipo;
       public         heap    postgres    false            ?            1259    16462    tab_produtos_tipo_cat_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.tab_produtos_tipo_cat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.tab_produtos_tipo_cat_id_seq;
       public          postgres    false    214            (           0    0    tab_produtos_tipo_cat_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.tab_produtos_tipo_cat_id_seq OWNED BY public.tab_produtos_tipo.cat_id;
          public          postgres    false    213            ?            1259    16453    tab_usuarios    TABLE       CREATE TABLE public.tab_usuarios (
    user_id integer NOT NULL,
    user_senha text NOT NULL,
    user_email text NOT NULL,
    user_imagemperfil text,
    user_horacadastro text,
    user_datacadastro date,
    ip_lancamento text,
    user_ultimoacesso date
);
     DROP TABLE public.tab_usuarios;
       public         heap    postgres    false            ?            1259    16444    tab_usuarios_token    TABLE     ?   CREATE TABLE public.tab_usuarios_token (
    token_id integer NOT NULL,
    usuario_id integer,
    token_hash text,
    token_usado text,
    token_expira_em date,
    ip_lancamento text
);
 &   DROP TABLE public.tab_usuarios_token;
       public         heap    postgres    false            ?            1259    16443    tab_usuarios_token_token_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.tab_usuarios_token_token_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.tab_usuarios_token_token_id_seq;
       public          postgres    false    210            )           0    0    tab_usuarios_token_token_id_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.tab_usuarios_token_token_id_seq OWNED BY public.tab_usuarios_token.token_id;
          public          postgres    false    209            ?            1259    16452    tab_usuarios_user_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.tab_usuarios_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.tab_usuarios_user_id_seq;
       public          postgres    false    212            *           0    0    tab_usuarios_user_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.tab_usuarios_user_id_seq OWNED BY public.tab_usuarios.user_id;
          public          postgres    false    211            z           2604    16493    tab_pedido ped_id    DEFAULT     v   ALTER TABLE ONLY public.tab_pedido ALTER COLUMN ped_id SET DEFAULT nextval('public.tab_pedido_ped_id_seq'::regclass);
 @   ALTER TABLE public.tab_pedido ALTER COLUMN ped_id DROP DEFAULT;
       public          postgres    false    219    220    220            y           2604    16484    tab_pedido_item peditem_id    DEFAULT     ?   ALTER TABLE ONLY public.tab_pedido_item ALTER COLUMN peditem_id SET DEFAULT nextval('public.tab_pedido_item_peditem_id_seq'::regclass);
 I   ALTER TABLE public.tab_pedido_item ALTER COLUMN peditem_id DROP DEFAULT;
       public          postgres    false    217    218    218            x           2604    16475    tab_produtos pro_id    DEFAULT     z   ALTER TABLE ONLY public.tab_produtos ALTER COLUMN pro_id SET DEFAULT nextval('public.tab_produtos_pro_id_seq'::regclass);
 B   ALTER TABLE public.tab_produtos ALTER COLUMN pro_id DROP DEFAULT;
       public          postgres    false    215    216    216            w           2604    16466    tab_produtos_tipo cat_id    DEFAULT     ?   ALTER TABLE ONLY public.tab_produtos_tipo ALTER COLUMN cat_id SET DEFAULT nextval('public.tab_produtos_tipo_cat_id_seq'::regclass);
 G   ALTER TABLE public.tab_produtos_tipo ALTER COLUMN cat_id DROP DEFAULT;
       public          postgres    false    214    213    214            v           2604    16456    tab_usuarios user_id    DEFAULT     |   ALTER TABLE ONLY public.tab_usuarios ALTER COLUMN user_id SET DEFAULT nextval('public.tab_usuarios_user_id_seq'::regclass);
 C   ALTER TABLE public.tab_usuarios ALTER COLUMN user_id DROP DEFAULT;
       public          postgres    false    212    211    212            u           2604    16447    tab_usuarios_token token_id    DEFAULT     ?   ALTER TABLE ONLY public.tab_usuarios_token ALTER COLUMN token_id SET DEFAULT nextval('public.tab_usuarios_token_token_id_seq'::regclass);
 J   ALTER TABLE public.tab_usuarios_token ALTER COLUMN token_id DROP DEFAULT;
       public          postgres    false    210    209    210                      0    16490 
   tab_pedido 
   TABLE DATA           {   COPY public.tab_pedido (ped_id, ped_datacadastro, ped_horacadastro, ip_lancamento, user_codigo, ped_cancelado) FROM stdin;
    public          postgres    false    220   ?:                 0    16481    tab_pedido_item 
   TABLE DATA           $  COPY public.tab_pedido_item (peditem_id, pedido_id, produto_id, peditem_qtdevendida, peditem_precounitario, peditem_aliquotaicms, peditem_aliquotaipi, peditem_datacadastro, peditem_horacadastro, ip_lancamento, user_codigo, peditem_precototal, peditem_precoicms, peditem_precoipi) FROM stdin;
    public          postgres    false    218   ?:                 0    16472    tab_produtos 
   TABLE DATA           ?   COPY public.tab_produtos (pro_id, pro_descricao, pro_precovenda, categoria_codigo, pro_ativo, pro_datacadastro, pro_horacadastro, ip_lancamento, user_codigo) FROM stdin;
    public          postgres    false    216   ;                 0    16463    tab_produtos_tipo 
   TABLE DATA           ?   COPY public.tab_produtos_tipo (cat_id, cat_descricao, cat_aliquotaicms, cat_aliquotaipi, cat_ativo, cat_datacadastro, cat_horacadastro, ip_lancamento, user_codigo) FROM stdin;
    public          postgres    false    214   -;                 0    16453    tab_usuarios 
   TABLE DATA           ?   COPY public.tab_usuarios (user_id, user_senha, user_email, user_imagemperfil, user_horacadastro, user_datacadastro, ip_lancamento, user_ultimoacesso) FROM stdin;
    public          postgres    false    212   J;                 0    16444    tab_usuarios_token 
   TABLE DATA           {   COPY public.tab_usuarios_token (token_id, usuario_id, token_hash, token_usado, token_expira_em, ip_lancamento) FROM stdin;
    public          postgres    false    210   g;       +           0    0    tab_pedido_item_peditem_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tab_pedido_item_peditem_id_seq', 1, false);
          public          postgres    false    217            ,           0    0    tab_pedido_ped_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.tab_pedido_ped_id_seq', 1, false);
          public          postgres    false    219            -           0    0    tab_produtos_pro_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tab_produtos_pro_id_seq', 1, false);
          public          postgres    false    215            .           0    0    tab_produtos_tipo_cat_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tab_produtos_tipo_cat_id_seq', 1, false);
          public          postgres    false    213            /           0    0    tab_usuarios_token_token_id_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.tab_usuarios_token_token_id_seq', 1, false);
          public          postgres    false    209            0           0    0    tab_usuarios_user_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.tab_usuarios_user_id_seq', 1, false);
          public          postgres    false    211            ?           2606    16488 $   tab_pedido_item tab_pedido_item_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.tab_pedido_item
    ADD CONSTRAINT tab_pedido_item_pkey PRIMARY KEY (peditem_id);
 N   ALTER TABLE ONLY public.tab_pedido_item DROP CONSTRAINT tab_pedido_item_pkey;
       public            postgres    false    218            ?           2606    16497    tab_pedido tab_pedido_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tab_pedido
    ADD CONSTRAINT tab_pedido_pkey PRIMARY KEY (ped_id);
 D   ALTER TABLE ONLY public.tab_pedido DROP CONSTRAINT tab_pedido_pkey;
       public            postgres    false    220            ?           2606    16479    tab_produtos tab_produtos_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tab_produtos
    ADD CONSTRAINT tab_produtos_pkey PRIMARY KEY (pro_id);
 H   ALTER TABLE ONLY public.tab_produtos DROP CONSTRAINT tab_produtos_pkey;
       public            postgres    false    216            ?           2606    16470 (   tab_produtos_tipo tab_produtos_tipo_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.tab_produtos_tipo
    ADD CONSTRAINT tab_produtos_tipo_pkey PRIMARY KEY (cat_id);
 R   ALTER TABLE ONLY public.tab_produtos_tipo DROP CONSTRAINT tab_produtos_tipo_pkey;
       public            postgres    false    214            ~           2606    16460    tab_usuarios tab_usuarios_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.tab_usuarios
    ADD CONSTRAINT tab_usuarios_pkey PRIMARY KEY (user_id);
 H   ALTER TABLE ONLY public.tab_usuarios DROP CONSTRAINT tab_usuarios_pkey;
       public            postgres    false    212            |           2606    16451 *   tab_usuarios_token tab_usuarios_token_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tab_usuarios_token
    ADD CONSTRAINT tab_usuarios_token_pkey PRIMARY KEY (token_id);
 T   ALTER TABLE ONLY public.tab_usuarios_token DROP CONSTRAINT tab_usuarios_token_pkey;
       public            postgres    false    210                  x?????? ? ?            x?????? ? ?            x?????? ? ?            x?????? ? ?            x?????? ? ?            x?????? ? ?     