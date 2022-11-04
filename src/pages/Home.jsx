import * as React from 'react';
import { Typography, Card, CardActionArea, CardMedia, CardContent, Grid, Rating, Container, Button, Stack } from '@mui/material';
import { useTheme } from '@mui/material/styles';
import ProductCardItems from 'components/cards/products/ProductCardItems';
import CarouselHome from 'components/carousel/CarouselHome';
import LocalFireDepartmentIcon from '@mui/icons-material/LocalFireDepartment';
const sampleData = [
    {
        id: 0,
        name: 'Đồng hồ 1',
        description: 'Ga osi ovemosoki kon hohon raepi jegjoted no ki waetahe',
        image: 'https://cdn3.dhht.vn/wp-content/uploads/2019/04/69_RE-AV0001S00B.jpg',
        price: '300000',
        rating: 4.5
    },
    {
        id: 1,
        name: 'Đồng hồ 2',
        description: 'Ga osi ovemosoki kon hohon raepi jegjoted no ki waetahe',
        image: 'https://cdn3.dhht.vn/wp-content/uploads/2019/04/69_RE-AV0001S00B.jpg',
        price: '600000',
        rating: 3
    },
    {
        id: 2,
        name: 'Đồng hồ 3',
        description: 'Ga osi ovemosoki kon hohon raepi jegjoted no ki waetahe',
        image: 'https://cdn3.dhht.vn/wp-content/uploads/2019/04/69_RE-AV0001S00B.jpg',
        price: '30000',
        rating: 3
    },
    {
        id: 3,
        name: 'Đồng hồ orient',
        description: 'Ga osi ovemosoki kon hohon raepi jegjoted no ki waetahe',
        image: 'https://cdn3.dhht.vn/wp-content/uploads/2019/04/69_RE-AV0001S00B.jpg',
        price: '30000',
        rating: 4.5
    },
    {
        id: 4,
        name: 'Đồng hồ 4',
        description: 'Ga osi ovemosoki kon hohon raepi jegjoted no ki waetahe',
        image: 'https://cdn3.dhht.vn/wp-content/uploads/2019/04/69_RE-AV0001S00B.jpg',
        price: '30000',
        rating: 4
    }
];

const Home = () => {
    const theme = useTheme();

    return (
        <Container sx={{ display: 'flex', flexDirection: 'column', rowGap: '1rem' }}>
            <CarouselHome />
            <ProductCardItems
                data={sampleData}
                title="Đồng hồ bán chạy nhất!"
                titleIcon={<LocalFireDepartmentIcon color="error" />}
                titleBackground="#ffec00"
            />
        </Container>
    );
};

export default Home;
