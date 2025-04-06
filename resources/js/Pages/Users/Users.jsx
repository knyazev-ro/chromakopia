import React, { useEffect, useMemo, useState } from 'react';
import axios from 'axios';
import ReusableTable from '@/Components/ReusableTable';
import Page from '../Layouts/Page';
import { router } from '@inertiajs/react';

const UserTable = () => {
  const [data, setData] = useState([]);
  const [total, setTotal] = useState(0);
  const [perPage, setPerPage] = useState(10);
  const [page, setPage] = useState(0);
  const [loading, setLoading] = useState(true);

  const columns = useMemo(() => [
    { accessorKey: 'id', header: 'ID' },
    { accessorKey: 'name', header: 'Имя' },
    { accessorKey: 'email', header: 'Email' },
    { accessorKey: 'branch.name', header: 'Филиал' },
    { accessorKey: 'sign', header: 'Подпись' },
  ], []);

  const fetchUsers = async () => {
    setLoading(true);
    try {
      const res = await axios.get(`/users`, {
        params: { page: page + 1, perPage }
      });
      setData(res.data.data);
      setTotal(res.data.total);
    } catch (error) {
      console.error('Ошибка загрузки данных:', error);
    }
    setLoading(false);
  };

  useEffect(() => {
    fetchUsers();
  }, [page, perPage]);

  const handlePageChange = (event, newPage) => setPage(newPage);
  const handleRowsPerPageChange = (event) => {
    setPerPage(parseInt(event.target.value, 10));
    setPage(0);
  };

  return (
    <Page>
    <ReusableTable
      columns={columns}
      data={data}
      total={total}
      loading={loading}
      page={page}
      perPage={perPage}
      onPageChange={handlePageChange}
      onRowsPerPageChange={handleRowsPerPageChange}
      title="Список пользователей"
      additionl={()=>(<>
        <button className='bg-blue-500 p-3 rounded-md text-white cursor-pointer active:bg-blue-500 hover:bg-blue-800 transition-colors'
        onClick={() => router.get(route('users.create'))}
        >
          Добавить пользователя
        </button>
      </>)}
    />
    </Page>
  );
};

export default UserTable;