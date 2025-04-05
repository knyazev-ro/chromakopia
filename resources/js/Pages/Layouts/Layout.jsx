import ClassicLayout from '@/Pages/Layouts/ClassicLayout.jsx';
import MobileLayout from '@/Pages/Layouts/MobileLayout.jsx';
import { usePage } from '@inertiajs/react';
import GuestLayout from './GuestLayout';

export default function Layout({ children }) {
    const { layout } = usePage().props;

    const lay = () => {switch (layout) {
        case 1:
            return <GuestLayout>{children}</GuestLayout>;

        case 2:
            return <MobileLayout>{children}</MobileLayout>;

        case 3:
            return <ClassicLayout>{children}</ClassicLayout>;

        default:
            return <GuestLayout>{children}</GuestLayout>;
    }}

    return <>
    <div className='h-screen overflow-y-hidden'>
        {lay()}
    </div>
    </>
}
