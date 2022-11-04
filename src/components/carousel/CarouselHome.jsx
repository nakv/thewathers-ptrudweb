import { useRef } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Autoplay } from 'swiper';
import { makeStyles } from '@mui/styles';
import { IconButton } from '@mui/material';
import KeyboardArrowLeftIcon from '@mui/icons-material/KeyboardArrowLeft';
import KeyboardArrowRightIcon from '@mui/icons-material/KeyboardArrowRight';
import config from 'config';

import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';

import 'swiper/css';
const useStyles = makeStyles({
    container: {
        position: 'relative'
    },
    carousel: {
        position: 'relative',
        borderRadius: config.borderRadius,
        overflow: 'hidden',
        '& .swiper-pagination-bullet': {
            width: '10px',
            height: '10px',
            backgroundColor: '#fff'
        },
        '& .swiper-pagination-bullet-active': { backgroundColor: '#ff2825' },
        '& .swiper-slide-active': { width: '100%' }
    },
    carouselItem: {
        width: '100%',
        height: '100%',
        '& img': {
            width: '100%',
            maxHeight: '25rem',
            objectFit: 'cover'
        }
    },
    next: {
        height: 'fit-content',
        margin: 'auto',
        position: 'absolute',
        top: '50%',
        right: 0,
        zIndex: 10,
        backgroundColor: '#fff !important',
        translate: '50% -50%'
    },
    prev: {
        height: 'fit-content',
        margin: 'auto',
        position: 'absolute',
        top: '50%',
        left: 0,
        zIndex: 10,
        backgroundColor: '#fff !important',
        translate: '-50% -50%'
    }
});
const CarouselHome = () => {
    const classes = useStyles();
    const images = [
        'https://cdn3.dhht.vn/wp-content/uploads/2020/12/banner-trang-suc.jpg',
        'https://cdn3.dhht.vn/wp-content/uploads/2019/02/BANNER_sieu-mong.jpg',
        'https://cdn3.dhht.vn/wp-content/uploads/2021/02/gioi-thieu-doxa-grandemetre-tuyet-tac-dong-ho-phien-ban-gioi-han.jpg',
        'https://cdn3.dhht.vn/wp-content/uploads/2019/02/BANNER_vang-18k.jpg',
        'https://cdn3.dhht.vn/wp-content/uploads/2019/06/banner-dong-ho-dinh-kim-cuong.jpg'
    ];
    const navigationPrevRef = useRef(null);
    const navigationNextRef = useRef(null);
    return (
        <div className={classes.container}>
            <IconButton variant="contained" color="secondary" className={classes.prev} ref={navigationPrevRef}>
                <KeyboardArrowLeftIcon />
            </IconButton>
            <Swiper
                spaceBetween={1}
                modules={[Navigation, Pagination, Autoplay]}
                loop={true}
                autoplay={{ delay: 5000 }}
                className={classes.carousel}
                pagination={{ clickable: true }}
                navigation={{
                    prevEl: navigationPrevRef.current,
                    nextEl: navigationNextRef.current
                }}
                slidesPerView={1}
                onInit={(swiper) => {
                    // Delay execution for the refs to be defined
                    setTimeout(() => {
                        // Override prevEl & nextEl now that refs are defined
                        swiper.params.navigation.prevEl = navigationPrevRef.current;
                        swiper.params.navigation.nextEl = navigationNextRef.current;

                        // Re-init navigation
                        swiper.navigation.destroy();
                        swiper.navigation.init();
                        swiper.navigation.update();
                    });
                }}
            >
                {images.map((image, index) => (
                    <SwiperSlide key={index} className={classes.carouselItem}>
                        <img alt={'image' + index} src={image} />
                    </SwiperSlide>
                ))}
            </Swiper>{' '}
            <IconButton variant="contained" color="secondary" className={classes.next} ref={navigationNextRef}>
                <KeyboardArrowRightIcon />
            </IconButton>
        </div>
    );
};

export default CarouselHome;
