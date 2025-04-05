export default function ApplicationLogo(props) {
    const { width, height } = props;

    return (
        <img
            src="https://storage.energybase.ru/thumbnails/316x150/11/1118984.png"
            width={width}
            height={height}
            alt=""
            class="d-none d-sm-block"
        />
    );
}
