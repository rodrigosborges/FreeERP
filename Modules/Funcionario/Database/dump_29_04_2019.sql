PGDMP     ,                    w            FreeERP    11.1    11.1 =    Q           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            R           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            S           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            T           1262    16857    FreeERP    DATABASE     �   CREATE DATABASE "FreeERP" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE "FreeERP";
             postgres    false            �            1259    16868    cargo    TABLE     �   CREATE TABLE public.cargo (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    horas_semanais integer NOT NULL,
    salario double precision NOT NULL,
    deleted_at timestamp(0) without time zone
);
    DROP TABLE public.cargo;
       public         postgres    false            �            1259    16866    cargo_id_seq    SEQUENCE     �   CREATE SEQUENCE public.cargo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.cargo_id_seq;
       public       postgres    false    199            U           0    0    cargo_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.cargo_id_seq OWNED BY public.cargo.id;
            public       postgres    false    198            �            1259    16876    contato    TABLE     �   CREATE TABLE public.contato (
    id integer NOT NULL,
    email character varying(100) NOT NULL,
    funcionario_id integer NOT NULL
);
    DROP TABLE public.contato;
       public         postgres    false            �            1259    16874    contato_id_seq    SEQUENCE     �   CREATE SEQUENCE public.contato_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.contato_id_seq;
       public       postgres    false    201            V           0    0    contato_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.contato_id_seq OWNED BY public.contato.id;
            public       postgres    false    200            �            1259    16885 	   documento    TABLE     �   CREATE TABLE public.documento (
    id integer NOT NULL,
    tipo character varying(255) NOT NULL,
    numero character varying(45) NOT NULL,
    comprovante character varying(255),
    funcionario_id integer NOT NULL
);
    DROP TABLE public.documento;
       public         postgres    false            �            1259    16883    documento_id_seq    SEQUENCE     �   CREATE SEQUENCE public.documento_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.documento_id_seq;
       public       postgres    false    203            W           0    0    documento_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.documento_id_seq OWNED BY public.documento.id;
            public       postgres    false    202            �            1259    16897    endereco    TABLE     y  CREATE TABLE public.endereco (
    id integer NOT NULL,
    funcionario_id integer NOT NULL,
    logradouro character varying(255) NOT NULL,
    numero integer NOT NULL,
    bairro character varying(100) NOT NULL,
    cidade character varying(100) NOT NULL,
    uf character varying(2) NOT NULL,
    cep character varying(8) NOT NULL,
    complemento character varying(100)
);
    DROP TABLE public.endereco;
       public         postgres    false            �            1259    16895    endereco_id_seq    SEQUENCE     �   CREATE SEQUENCE public.endereco_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.endereco_id_seq;
       public       postgres    false    205            X           0    0    endereco_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.endereco_id_seq OWNED BY public.endereco.id;
            public       postgres    false    204            �            1259    16909    estado_civil    TABLE     g   CREATE TABLE public.estado_civil (
    id integer NOT NULL,
    nome character varying(60) NOT NULL
);
     DROP TABLE public.estado_civil;
       public         postgres    false            �            1259    16907    estado_civil_id_seq    SEQUENCE     �   CREATE SEQUENCE public.estado_civil_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.estado_civil_id_seq;
       public       postgres    false    207            Y           0    0    estado_civil_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.estado_civil_id_seq OWNED BY public.estado_civil.id;
            public       postgres    false    206            �            1259    16917    funcionario    TABLE     y  CREATE TABLE public.funcionario (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    data_nascimento date NOT NULL,
    estado_civil_id integer NOT NULL,
    sexo boolean NOT NULL,
    data_admissao date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);
    DROP TABLE public.funcionario;
       public         postgres    false            �            1259    16915    funcionario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.funcionario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.funcionario_id_seq;
       public       postgres    false    209            Z           0    0    funcionario_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.funcionario_id_seq OWNED BY public.funcionario.id;
            public       postgres    false    208            �            1259    16926    historico_cargo    TABLE     �   CREATE TABLE public.historico_cargo (
    id integer NOT NULL,
    cargo_id integer NOT NULL,
    funcionario_id integer NOT NULL,
    data_entrada date NOT NULL,
    data_saida date NOT NULL
);
 #   DROP TABLE public.historico_cargo;
       public         postgres    false            �            1259    16924    historico_cargo_id_seq    SEQUENCE     �   CREATE SEQUENCE public.historico_cargo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.historico_cargo_id_seq;
       public       postgres    false    211            [           0    0    historico_cargo_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.historico_cargo_id_seq OWNED BY public.historico_cargo.id;
            public       postgres    false    210            �            1259    16860 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         postgres    false            �            1259    16858    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public       postgres    false    197            \           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
            public       postgres    false    196            �            1259    16934    telefone    TABLE     �   CREATE TABLE public.telefone (
    id integer NOT NULL,
    numero character varying(45) NOT NULL,
    contato_id integer NOT NULL
);
    DROP TABLE public.telefone;
       public         postgres    false            �            1259    16932    telefone_id_seq    SEQUENCE     �   CREATE SEQUENCE public.telefone_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.telefone_id_seq;
       public       postgres    false    213            ]           0    0    telefone_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.telefone_id_seq OWNED BY public.telefone.id;
            public       postgres    false    212            �
           2604    16871    cargo id    DEFAULT     d   ALTER TABLE ONLY public.cargo ALTER COLUMN id SET DEFAULT nextval('public.cargo_id_seq'::regclass);
 7   ALTER TABLE public.cargo ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    199    198    199            �
           2604    16879 
   contato id    DEFAULT     h   ALTER TABLE ONLY public.contato ALTER COLUMN id SET DEFAULT nextval('public.contato_id_seq'::regclass);
 9   ALTER TABLE public.contato ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    200    201    201            �
           2604    16888    documento id    DEFAULT     l   ALTER TABLE ONLY public.documento ALTER COLUMN id SET DEFAULT nextval('public.documento_id_seq'::regclass);
 ;   ALTER TABLE public.documento ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    202    203    203            �
           2604    16900    endereco id    DEFAULT     j   ALTER TABLE ONLY public.endereco ALTER COLUMN id SET DEFAULT nextval('public.endereco_id_seq'::regclass);
 :   ALTER TABLE public.endereco ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    204    205    205            �
           2604    16912    estado_civil id    DEFAULT     r   ALTER TABLE ONLY public.estado_civil ALTER COLUMN id SET DEFAULT nextval('public.estado_civil_id_seq'::regclass);
 >   ALTER TABLE public.estado_civil ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    207    206    207            �
           2604    16920    funcionario id    DEFAULT     p   ALTER TABLE ONLY public.funcionario ALTER COLUMN id SET DEFAULT nextval('public.funcionario_id_seq'::regclass);
 =   ALTER TABLE public.funcionario ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    208    209    209            �
           2604    16929    historico_cargo id    DEFAULT     x   ALTER TABLE ONLY public.historico_cargo ALTER COLUMN id SET DEFAULT nextval('public.historico_cargo_id_seq'::regclass);
 A   ALTER TABLE public.historico_cargo ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    210    211    211            �
           2604    16863    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196    197            �
           2604    16937    telefone id    DEFAULT     j   ALTER TABLE ONLY public.telefone ALTER COLUMN id SET DEFAULT nextval('public.telefone_id_seq'::regclass);
 :   ALTER TABLE public.telefone ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    213    212    213            �
           2606    16873    cargo cargo_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.cargo
    ADD CONSTRAINT cargo_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.cargo DROP CONSTRAINT cargo_pkey;
       public         postgres    false    199            �
           2606    16881    contato contato_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.contato
    ADD CONSTRAINT contato_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.contato DROP CONSTRAINT contato_pkey;
       public         postgres    false    201            �
           2606    16893    documento documento_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.documento
    ADD CONSTRAINT documento_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.documento DROP CONSTRAINT documento_pkey;
       public         postgres    false    203            �
           2606    16905    endereco endereco_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT endereco_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.endereco DROP CONSTRAINT endereco_pkey;
       public         postgres    false    205            �
           2606    16914    estado_civil estado_civil_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.estado_civil
    ADD CONSTRAINT estado_civil_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.estado_civil DROP CONSTRAINT estado_civil_pkey;
       public         postgres    false    207            �
           2606    16922    funcionario funcionario_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.funcionario DROP CONSTRAINT funcionario_pkey;
       public         postgres    false    209            �
           2606    16931 $   historico_cargo historico_cargo_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.historico_cargo
    ADD CONSTRAINT historico_cargo_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.historico_cargo DROP CONSTRAINT historico_cargo_pkey;
       public         postgres    false    211            �
           2606    16865    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public         postgres    false    197            �
           2606    16939    telefone telefone_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.telefone
    ADD CONSTRAINT telefone_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.telefone DROP CONSTRAINT telefone_pkey;
       public         postgres    false    213            �
           1259    16882    fk_contato_funcionario1    INDEX     U   CREATE INDEX fk_contato_funcionario1 ON public.contato USING btree (funcionario_id);
 +   DROP INDEX public.fk_contato_funcionario1;
       public         postgres    false    201            �
           1259    16894    fk_documento_funcionario1    INDEX     Y   CREATE INDEX fk_documento_funcionario1 ON public.documento USING btree (funcionario_id);
 -   DROP INDEX public.fk_documento_funcionario1;
       public         postgres    false    203            �
           1259    16906    fk_endereco_funcionario    INDEX     V   CREATE INDEX fk_endereco_funcionario ON public.endereco USING btree (funcionario_id);
 +   DROP INDEX public.fk_endereco_funcionario;
       public         postgres    false    205            �
           1259    16923    fk_funcionario_estado_civil1    INDEX     _   CREATE INDEX fk_funcionario_estado_civil1 ON public.funcionario USING btree (estado_civil_id);
 0   DROP INDEX public.fk_funcionario_estado_civil1;
       public         postgres    false    209            �
           1259    16940    fk_telefone_contato1    INDEX     O   CREATE INDEX fk_telefone_contato1 ON public.telefone USING btree (contato_id);
 (   DROP INDEX public.fk_telefone_contato1;
       public         postgres    false    213            �
           2606    16941    contato fk_contato_funcionario1    FK CONSTRAINT     �   ALTER TABLE ONLY public.contato
    ADD CONSTRAINT fk_contato_funcionario1 FOREIGN KEY (funcionario_id) REFERENCES public.funcionario(id);
 I   ALTER TABLE ONLY public.contato DROP CONSTRAINT fk_contato_funcionario1;
       public       postgres    false    201    209    2761            �
           2606    16946 #   documento fk_documento_funcionario1    FK CONSTRAINT     �   ALTER TABLE ONLY public.documento
    ADD CONSTRAINT fk_documento_funcionario1 FOREIGN KEY (funcionario_id) REFERENCES public.funcionario(id);
 M   ALTER TABLE ONLY public.documento DROP CONSTRAINT fk_documento_funcionario1;
       public       postgres    false    203    209    2761            �
           2606    16951     endereco fk_endereco_funcionario    FK CONSTRAINT     �   ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT fk_endereco_funcionario FOREIGN KEY (funcionario_id) REFERENCES public.funcionario(id);
 J   ALTER TABLE ONLY public.endereco DROP CONSTRAINT fk_endereco_funcionario;
       public       postgres    false    2761    209    205            �
           2606    16956 (   funcionario fk_funcionario_estado_civil1    FK CONSTRAINT     �   ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT fk_funcionario_estado_civil1 FOREIGN KEY (estado_civil_id) REFERENCES public.estado_civil(id);
 R   ALTER TABLE ONLY public.funcionario DROP CONSTRAINT fk_funcionario_estado_civil1;
       public       postgres    false    209    2758    207            �
           2606    16961 )   historico_cargo fk_historico_cargo_cargo1    FK CONSTRAINT     �   ALTER TABLE ONLY public.historico_cargo
    ADD CONSTRAINT fk_historico_cargo_cargo1 FOREIGN KEY (cargo_id) REFERENCES public.cargo(id);
 S   ALTER TABLE ONLY public.historico_cargo DROP CONSTRAINT fk_historico_cargo_cargo1;
       public       postgres    false    2747    211    199            �
           2606    16966 /   historico_cargo fk_historico_cargo_funcionario1    FK CONSTRAINT     �   ALTER TABLE ONLY public.historico_cargo
    ADD CONSTRAINT fk_historico_cargo_funcionario1 FOREIGN KEY (funcionario_id) REFERENCES public.funcionario(id);
 Y   ALTER TABLE ONLY public.historico_cargo DROP CONSTRAINT fk_historico_cargo_funcionario1;
       public       postgres    false    2761    209    211            �
           2606    16971    telefone fk_telefone_contato1    FK CONSTRAINT     �   ALTER TABLE ONLY public.telefone
    ADD CONSTRAINT fk_telefone_contato1 FOREIGN KEY (contato_id) REFERENCES public.contato(id);
 G   ALTER TABLE ONLY public.telefone DROP CONSTRAINT fk_telefone_contato1;
       public       postgres    false    213    201    2749           